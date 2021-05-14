<?php

declare(strict_types=1);
/**
 * Contains the RequestFactory class.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Vanilo\Euplatesc\Factories;

use Vanilo\Contracts\Address;
use Vanilo\Euplatesc\Concerns\InteractsWithEuplatesc;
use Vanilo\Euplatesc\Dto\EuplatescAddress;
use Vanilo\Euplatesc\Messages\EuplatescPaymentRequest;
use Vanilo\Payment\Contracts\Payment;

class RequestFactory
{
    use InteractsWithEuplatesc;

    public function buildFromPayment(
        Payment $payment,
        Address $shippingAddress = null,
        array $options = []
    ): EuplatescPaymentRequest {
        $result = new EuplatescPaymentRequest($this->merchantId, $this->encryptionKey);
        $billingAddress = EuplatescAddress::fromVaniloBillpayer($payment->getPayable()->getBillPayer());
        $shippingAddress = $shippingAddress ? EuplatescAddress::fromVaniloAddress($shippingAddress) : $billingAddress;

        $result->setAmount($payment->getAmount())
            ->setCurrency($payment->getCurrency())
            ->setInvoiceId($payment->getPaymentId())
            ->setOrderDescription($options['description'] ?? __('Order no. :number', ['number' => $payment->getPayable()->getTitle()]))
            ->setBillingAddress($billingAddress)
            ->setShippingAddress($shippingAddress);

        return $result;
    }
}
