<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Repository;

use Ramsey\Uuid\UuidInterface;
use Extensions\Classes\Credit\Application\Repository\Exception\ConfirmationAlreadyAttachedException;
use Extensions\Classes\Credit\Application\Repository\Exception\ConfirmationNotFoundException;
use Extensions\Classes\Credit\Application\Repository\Exception\RepositoryFailedException;

interface BrokerConfirmationRepositoryInterface
{
    /**
     * @throws RepositoryFailedException
     * @throws ConfirmationNotFoundException
     */
    public function get(UuidInterface $confirmId): Confirmation;

    /**
     * @throws RepositoryFailedException
     * @throws ConfirmationNotFoundException
     * @throws ConfirmationAlreadyAttachedException
     */
    public function attachCredit(UuidInterface $confirmId, UuidInterface $creditId): void;
}
