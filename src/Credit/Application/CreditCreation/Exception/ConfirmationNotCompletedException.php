<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\CreditCreation\Exception;

final class ConfirmationNotCompletedException extends \RuntimeException implements CreateCreditRejectedException
{
    public function __construct()
    {
        parent::__construct('Confirmation is not completed.');
    }
}
