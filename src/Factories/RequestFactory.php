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
use Vanilo\Contracts\Payable;

class RequestFactory
{
    use InteractsWithEuplatesc;

    public function buildFromPayable(Payable $payable, string $description = null): EuplatescPaymentRequest
    {
        $result          = new EuplatescPaymentRequest($this->merchantId, $this->encryptionKey);
        $billingAddress  = EuplatescAddress::fromVaniloAddress($payable->getBillingAddress());
        $shippingAddress = $billingAddress;

        if ($payable->needsShipping()) {
            $shippingAddress = EuplatescAddress::fromVaniloAddress(
                $payable->getShippable()->getShippingAddress()
            );
        }

        $result->setAmount($payable->getAmount())
            ->setCurrency($payable->getCurrency())
            ->setInvoiceId($payable->getId())
            ->setOrderDescription($description ?? __('Order with number %s', $payable->getId()))
            ->setBillingAddress($billingAddress)
            ->setShippingAddress($shippingAddress);

        return $result;
    }
}
