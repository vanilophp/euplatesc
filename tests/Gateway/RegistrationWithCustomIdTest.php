<?php
/**
 * Contains the GatewayWithCustomIdRegistrationTest class.
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

class RegistrationWithCustomIdTest extends TestCase
{
    protected function setUp(): void
    {
        PaymentGateways::reset();
        parent::setUp();
    }

    /** @test */
    public function the_gateway_id_can_be_changed_from_within_the_configuration()
    {
        $this->assertCount(2, PaymentGateways::ids());
        $this->assertContains('yesipay', PaymentGateways::ids());
    }

    /** @test */
    public function the_gateway_can_be_instantiated()
    {
        $euplatescGateway = PaymentGateways::make('yesipay');

        $this->assertInstanceOf(PaymentGateway::class, $euplatescGateway);
        $this->assertInstanceOf(EuplatescPaymentGateway::class, $euplatescGateway);
    }

    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);

        config(['vanilo.euplatesc.gateway.id' => 'yesipay']);
    }
}
