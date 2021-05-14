<?php

declare(strict_types=1);

/**
 * Contains the SomeBillPayer class.
 *
 * @copyright   Copyright (c) 2020 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2020-12-26
 *
 */

namespace Vanilo\Euplatesc\Tests\Dummies;

use Vanilo\Contracts\Address;
use Vanilo\Contracts\Billpayer;

class SomeBillPayer implements Billpayer
{
    private $email;

    private $firstname;

    private $lastname;

    public function __construct(
        string $email = 'someone@example.org',
        string $firstname = 'Giovanni',
        string $lastname = 'Gatto'
    ) {
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function isEuRegistered(): bool
    {
        return false;
    }

    public function getBillingAddress(): Address
    {
        return new SomeAddress($this->getFullName());
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return null;
    }

    public function getName(): string
    {
        return $this->getFullName();
    }

    public function isOrganization(): bool
    {
        return false;
    }

    public function isIndividual(): bool
    {
        return true;
    }

    public function getCompanyName(): ?string
    {
        return null;
    }

    public function getTaxNumber(): ?string
    {
        return null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstname;
    }

    public function getLastName(): ?string
    {
        return $this->lastname;
    }

    public function getFullName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
