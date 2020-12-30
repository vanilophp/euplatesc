<?php

declare(strict_types=1);

/**
 * Contains the RequestFactoryTest class.
 *
 * @copyright   Copyright (c) 2020 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2020-12-26
 *
 */

namespace Konekt\Euplatesc\Tests\Factory;

use Konekt\Euplatesc\EuplatescPaymentGateway;
use Konekt\Euplatesc\Factories\RequestFactory;
use Konekt\Euplatesc\Messages\EuplatescPaymentRequest;
use Konekt\Euplatesc\Tests\Dummies\Order;
use Konekt\Euplatesc\Tests\Dummies\SomeOrder;
use Konekt\Euplatesc\Tests\TestCase;
use Vanilo\Payment\Factories\PaymentFactory;
use Vanilo\Payment\Models\PaymentMethod;

class RequestFactoryTest extends TestCase
{
    /** @test */
    public function it_creates_a_response_object()
    {
        $factory = new RequestFactory('mid', 'some-key');
        $method = PaymentMethod::create([
            'gateway' => EuplatescPaymentGateway::getName(),
            'name' => 'EuPlatesc',
        ]);

        $order = Order::create(['currency' => 'USD', 'amount' => 13.99]);

        $payment = PaymentFactory::createFromPayable($order, $method);

        $this->assertInstanceOf(
            EuplatescPaymentRequest::class,
            $factory->buildFromPayment($payment)
        );
    }
}
