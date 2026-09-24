<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\CreditCreation;

use Extensions\Classes\Core\Domain\ValueObject\Phone;
use Extensions\Classes\Credit\Domain\Entity\CreditCustomer\CreditCustomer;
use Extensions\Classes\Credit\Domain\Entity\CreditOrderItem\CreditOrderItem;
use Extensions\Classes\Credit\Application\CreditCreation\Dto\CreateCreditCommand;
use Extensions\Classes\Credit\Application\CreditCreation\Dto\CreateCreditSuccess;
use Extensions\Classes\Credit\Application\CreditCreation\Exception\ConfirmationNotCompletedException;
use Extensions\Classes\Credit\Application\CreditCreation\Exception\CreateCreditFailedException;
use Extensions\Classes\Credit\Application\CreditCreation\Exception\CreateCreditRejectedException;
use Extensions\Classes\Credit\Application\Repository\BrokerConfirmationRepositoryInterface;
use Extensions\Classes\Credit\Application\Repository\BrokerConfirmationRepositoryProvider;
use Extensions\Classes\Credit\Application\Repository\BrokerCreditRepositoryProvider;
use Extensions\Classes\Credit\Application\Repository\CreditCustomerRepositoryInterface;
use Extensions\Classes\Credit\Application\Repository\CreditOrderItemRepositoryInterface;
use Extensions\Classes\Credit\Application\Repository\Exception\RepositoryFailedException;
use Extensions\Classes\Credit\Application\Transaction\TransactionInterface;
use Extensions\Classes\Credit\Application\Logger\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class CreateCreditHandler
{
    public function __construct(
        private BrokerConfirmationRepositoryProvider $confirmationRepositoryProvider,
        private CreditCustomerRepositoryInterface $customerRepository,
        private BrokerCreditFactoryProvider $creditFactoryProvider,
        private BrokerCreditRepositoryProvider $creditRepositoryProvider,
        private CreditOrderItemRepositoryInterface $orderItemRepository,
        private TransactionInterface $transaction,
        private LoggerInterface $logger,
    ) {
    }

    /**
     * @throws CreateCreditRejectedException
     * @throws CreateCreditFailedException
     */
    public function handle(CreateCreditCommand $command): CreateCreditSuccess
    {
        try {
            $this->transaction->begin();

            $brokerConfirmationRepository = $this->confirmationRepositoryProvider->forBroker($command->broker);

            $confirmedPhone = $this->getConfirmedPhone($brokerConfirmationRepository, $command->confirmId);

            $customerId = $this->createCustomer($command, $confirmedPhone);

            $creditId = $this->createCredit($command, $customerId);

            $this->attachCreditProducts($creditId, $command);

            $brokerConfirmationRepository->attachCredit($command->confirmId, $creditId);

            //TODO: implements add to outbox

            $this->transaction->commit();

            return new CreateCreditSuccess(
                creditId: $creditId
            );
        } catch (CreateCreditRejectedException $exception) {
            $this->transaction->rollback();

            throw $exception;
        } catch (\Throwable $exception) {
            $this->transaction->rollback();

            $this->logger->error(
                'Credit creation failed',
                [
                    'broker' => $command->broker->toString(),
                    'confirm_id' => $command->confirmId->toString(),
                    'exception_class' => $exception::class,
                    'exception_message' => $exception->getMessage(),
                ]
            );

            throw new CreateCreditFailedException(
                confirmId: $command->confirmId,
                previous: $exception,
            );
        }
    }

    /**
     * @throws CreateCreditRejectedException
     * @throws RepositoryFailedException
     */
    private function getConfirmedPhone(BrokerConfirmationRepositoryInterface $confirmationRepository, UuidInterface $confirmId): Phone
    {
        $confirmation = $confirmationRepository->get($confirmId);

        if (!$confirmation->isConfirmed()) {
            throw new ConfirmationNotCompletedException();
        }

        return $confirmation->getPhone();
    }

    /** @throws RepositoryFailedException */
    private function createCustomer(CreateCreditCommand $command, Phone $confirmedPhone): UuidInterface
    {
        $customerId = Uuid::uuid7();

        $this->customerRepository->save(
            new CreditCustomer(
                id: $customerId,
                phone: $confirmedPhone,
                lastName: $command->lastName,
                firstName: $command->firstName,
                middleName: $command->middleName,
                email: $command->email,
            )
        );

        return $customerId;
    }

    /** @throws RepositoryFailedException */
    private function createCredit(CreateCreditCommand $command, UuidInterface $customerId): UuidInterface
    {
        $broker = $command->broker;

        $credit = $this->creditFactoryProvider->forBroker($broker)->create($customerId, $command->payload);

        $this->creditRepositoryProvider->forBroker($broker)->save($credit);

        return $credit->id;
    }

    /**
     * @throws RepositoryFailedException
     */
    private function attachCreditProducts(UuidInterface $creditId, CreateCreditCommand $command): void
    {
        foreach ($command->orderItemsPayload as $itemPayload) {
            $this->orderItemRepository->save(
                new CreditOrderItem(
                    id: Uuid::uuid7(),
                    creditId: $creditId,
                    productId: $itemPayload->productId,
                    quantity: $itemPayload->quantity,
                    quantityMeasure: $itemPayload->quantityMeasure,
                    productSnapshot: $itemPayload->productSnapshot,
                    createdAt: new \DateTimeImmutable('now'),
                )
            );
        }
    }
}
