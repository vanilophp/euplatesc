<?php

declare(strict_types=1);

/**
 * Contains the Order class.
 *
 * @copyright   Copyright (c) 2020 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2020-12-30
 *
 */

namespace Vanilo\Euplatesc\Tests\Dummies;

use Illuminate\Database\Eloquent\Model;
use Traversable;
use Vanilo\Contracts\Billpayer;
use Vanilo\Contracts\Payable;

class Order extends Model implements Payable
{
    protected $fillable = ['amount', 'currency'];

    public function getPayableId(): string
    {
        return (string) $this->id;
    }

    public function getPayableType(): string
    {
        return self::class;
    }

    public function getTitle(): string
    {
        return 'Order #' . $this->id;
    }

    public function getAmount(): float
    {
        return floatval($this->amount);
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getBillpayer(): ?Billpayer
    {
        return new SomeBillPayer();
    }

    public function getNumber(): string
    {
        // TODO: Implement getNumber() method.
    }

    public function getPayableRemoteId(): ?string
    {
        // TODO: Implement getPayableRemoteId() method.
    }

    public function setPayableRemoteId(string $remoteId): void
    {
        // TODO: Implement setPayableRemoteId() method.
    }

    public static function findByPayableRemoteId(string $remoteId): ?Payable
    {
        // TODO: Implement findByPayableRemoteId() method.
    }

    public function hasItems(): bool
    {
        return false;
    }

    public function getItems(): Traversable
    {
        return collect();
    }
}
