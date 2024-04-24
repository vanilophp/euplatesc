<?php

declare(strict_types=1);

/**
 * Contains the SomeShippingAddress class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-05-14
 *
 */

namespace Vanilo\Euplatesc\Tests\Dummies;

use Vanilo\Contracts\Address;

class SomeShippingAddress implements Address
{
    private string $name;

    private string $country;

    private string $province;

    private string $zip;

    private string $city;

    private string $address;

    public function __construct(string $name, string $country, string $province, string $zip, string $city, string $address)
    {
        $this->name = $name;
        $this->country = $country;
        $this->province = $province;
        $this->zip = $zip;
        $this->city = $city;
        $this->address = $address;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountryCode(): string
    {
        return $this->country;
    }

    public function getProvinceCode(): ?string
    {
        return $this->province;
    }

    public function getPostalCode(): ?string
    {
        return $this->zip;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getAddress2(): ?string
    {
        return null;
    }
}
