<?php

declare(strict_types=1);

/**
 * Contains the ComparesAddresses trait.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-05-14
 *
 */

namespace Vanilo\Euplatesc\Tests;

use Vanilo\Contracts\Address;
use Vanilo\Euplatesc\Dto\EuplatescAddress;

trait ComparesAddresses
{
    private function assertAddressEquals(Address $expected, EuplatescAddress $actual)
    {
        $this->assertEquals($expected->getCity(), $actual->getCity());
        $this->assertEquals($expected->getAddress(), $actual->getAddress());
        $this->assertEquals($expected->getCountryCode(), $actual->getCountry());
        $this->assertEquals($expected->getPostalCode(), $actual->getZip());
        $this->assertStringContainsString($actual->getFirstName(), $expected->getName());
        $this->assertStringContainsString($actual->getLastName(), $expected->getName());
    }
}
