<?php

declare(strict_types=1);

/**
 * Contains the SomeAddress class.
 *
 * @copyright   Copyright (c) 2020 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2020-12-26
 *
 */

namespace Vanilo\Euplatesc\Tests\Dummies;

use Vanilo\Contracts\Address;

class SomeAddress implements Address
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountryCode(): string
    {
        return 'DK';
    }

    public function getProvinceCode(): ?string
    {
        return '85';
    }

    public function getPostalCode(): ?string
    {
        return '4874';
    }

    public function getCity(): ?string
    {
        return 'Gedser';
    }

    public function getAddress(): string
    {
        return '23 Strandvej';
    }
}
