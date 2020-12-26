<?php
/**
 * Contains the RequestFactory class.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Konekt\Euplatesc\Factories;

use Konekt\Euplatesc\Concerns\InteractsWithEuplatesc;
use Konekt\Euplatesc\Dto\EuplatescAddress;
use Konekt\Euplatesc\Messages\EuplatescPaymentRequest;
use Vanilo\Contracts\Address;
use Vanilo\Contracts\Payable;

class RequestFactory
{
    use InteractsWithEuplatesc;

    public function buildFromPayable(
        Payable $payable,
        Address $shippingAddress = null,
        array $options = []
    ): EuplatescPaymentRequest {
        $result = new EuplatescPaymentRequest($this->merchantId, $this->encryptionKey);
        $billingAddress = EuplatescAddress::fromVaniloBillpayer($payable->getBillPayer());
        $shippingAddress = $shippingAddress ? EuplatescAddress::fromVaniloAddress($shippingAddress) : $billingAddress;

        $result->setAmount($payable->getAmount())
            ->setCurrency($payable->getCurrency())
            ->setInvoiceId($payable->getPayableId())
            ->setOrderDescription($options['description'] ?? __('Order with number :number', ['number' => $payable->getPayableId()]))
            ->setBillingAddress($billingAddress)
            ->setShippingAddress($shippingAddress);

        return $result;
    }
}
