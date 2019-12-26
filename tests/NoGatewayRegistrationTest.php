<?php
/**
 * Contains the NoGatewayRegistrationTest class.
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

class NoGatewayRegistrationTest extends TestCase
{
    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);

        config(['konekt.euplatesc.gateway.register' => false]);
    }

    /** @test */
    public function the_gateway_registration_can_be_disabled()
    {
        $this->assertCount(0, PaymentGateways::ids());
    }
}
