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

namespace Vanilo\Euplatesc\Tests\Gateway;

use Vanilo\Euplatesc\EuplatescPaymentGateway;
use Vanilo\Euplatesc\Tests\TestCase;
use Vanilo\Payment\Contracts\PaymentGateway;
use Vanilo\Payment\PaymentGateways;

class RegistrationTest extends TestCase
{
    /** @test */
    public function the_gateway_is_registered_out_of_the_box_with_defaults()
    {
        $this->assertCount(2, PaymentGateways::ids());
        $this->assertContains(EuplatescPaymentGateway::DEFAULT_ID, PaymentGateways::ids());
    }

    /** @test */
    public function the_gateway_can_be_instantiated()
    {
        $euplatescGateway = PaymentGateways::make('euplatesc');

        $this->assertInstanceOf(PaymentGateway::class, $euplatescGateway);
        $this->assertInstanceOf(EuplatescPaymentGateway::class, $euplatescGateway);
    }
}
