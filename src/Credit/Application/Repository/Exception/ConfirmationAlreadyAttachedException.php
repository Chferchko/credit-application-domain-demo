<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Repository\Exception;

use Extensions\Classes\Credit\Application\CreditCreation\Exception\CreateCreditRejectedException;

interface ConfirmationAlreadyAttachedException extends CreateCreditRejectedException
{
}
