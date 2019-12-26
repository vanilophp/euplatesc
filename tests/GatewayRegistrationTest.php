<?php
/**
 * Contains the GatewayRegistrationTest class.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Konekt\Euplatesc\Tests;

use Konekt\Euplatesc\EuplatescPaymentGateway;
use Vanilo\Payment\PaymentGateways;

class GatewayRegistrationTest extends TestCase
{
    /** @test */
    public function the_gateway_is_registered_out_of_the_box_with_defaults()
    {
        $this->assertCount(1, PaymentGateways::ids());
        $this->assertContains(EuplatescPaymentGateway::DEFAULT_ID, PaymentGateways::ids());
    }
}
