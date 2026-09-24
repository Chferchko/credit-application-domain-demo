<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Domain\Entity\Credit;

enum InternalStatus
{
    case AwaitingBrokerSend;
    case SentToBroker;
    case BrokerSendFailed;
    case Expired;

    public function toString(): string
    {
        return match ($this) {
            self::AwaitingBrokerSend => 'awaiting_broker_send',
            self::SentToBroker => 'sent_to_broker',
            self::BrokerSendFailed => 'broker_send_failed',
            self::Expired => 'expired',
        };
    }

    public static function fromString(string $status): self
    {
        return match ($status) {
            'awaiting_broker_send' => self::AwaitingBrokerSend,
            'sent_to_broker' => self::SentToBroker,
            'broker_send_failed' => self::BrokerSendFailed,
            'expired' => self::Expired,
            default => throw new \InvalidArgumentException(sprintf('Unknown internal status "%s".', $status)),
        };
    }
}
