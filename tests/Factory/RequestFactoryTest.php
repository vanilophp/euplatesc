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

namespace Vanilo\Euplatesc\Tests\Factory;

use Illuminate\Support\Carbon;
use Vanilo\Euplatesc\EuplatescPaymentGateway;
use Vanilo\Euplatesc\Factories\RequestFactory;
use Vanilo\Euplatesc\Messages\EuplatescPaymentRequest;
use Vanilo\Euplatesc\Tests\ComparesAddresses;
use Vanilo\Euplatesc\Tests\Dummies\Order;
use Vanilo\Euplatesc\Tests\Dummies\SomeShippingAddress;
use Vanilo\Euplatesc\Tests\TestCase;
use Vanilo\Payment\Factories\PaymentFactory;
use Vanilo\Payment\Models\PaymentMethod;

class RequestFactoryTest extends TestCase
{
    use ComparesAddresses;

    /** @test */
    public function it_creates_a_request_object()
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

    /** @test */
    public function the_created_request_contains_valid_data()
    {
        $factory = new RequestFactory('8877665544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $method = PaymentMethod::create([
            'gateway' => EuplatescPaymentGateway::getName(),
            'name' => 'EuPlatesc',
        ]);

        Carbon::setTestNow('2021-05-14T11:35:27');
        /** @var Order $order */
        $order = Order::create(['currency' => 'EUR', 'amount' => 35.49]);

        $payment = PaymentFactory::createFromPayable($order, $method);
        $request = $factory->buildFromPayment($payment);

        $this->assertEquals('8877665544', $request->getMerchantId());
        $this->assertEquals(35.49, $request->getAmount());
        $this->assertEquals('35.49', $request->getAmountNumericFmt());
        $this->assertEquals('EUR', $request->getCurrency());
        $this->assertEquals('20210514113527', $request->getTimestamp());
        $this->assertGreaterThanOrEqual(32, strlen($request->getFpHash()));
        $this->assertEquals($payment->getPaymentId(), $request->getInvoiceId());
        $this->assertAddressEquals($order->getBillpayer()->getBillingAddress(), $request->getBillingAddress());
    }

    /** @test */
    public function it_uses_the_billing_address_as_shipping_address_if_no_explicit_shipping_address_gets_passed()
    {
        $factory = new RequestFactory('8877665544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $method = PaymentMethod::create([
            'gateway' => EuplatescPaymentGateway::getName(),
            'name' => 'EuPlatesc',
        ]);

        /** @var Order $order */
        $order = Order::create(['currency' => 'EUR', 'amount' => 35.49]);

        $payment = PaymentFactory::createFromPayable($order, $method);
        $request = $factory->buildFromPayment($payment);

        $this->assertAddressEquals($order->getBillpayer()->getBillingAddress(), $request->getShippingAddress());
    }

    /** @test */
    public function it_uses_the_explicitly_passed_shipping_address()
    {
        $factory = new RequestFactory('8877665544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $method = PaymentMethod::create([
            'gateway' => EuplatescPaymentGateway::getName(),
            'name' => 'EuPlatesc',
        ]);

        /** @var Order $order */
        $order = Order::create(['currency' => 'EUR', 'amount' => 35.49]);

        $payment = PaymentFactory::createFromPayable($order, $method);
        $shippingAddress = new SomeShippingAddress('Florin Salam', 'RO', 'B', '104071', 'Bucuresti', 'Vila cu Roxana');
        $request = $factory->buildFromPayment($payment, $shippingAddress);

        $this->assertAddressEquals($shippingAddress, $request->getShippingAddress());
    }
}
