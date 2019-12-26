<?php
/**
 * Contains the EuplatescPaymentRequest class.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Konekt\Euplatesc\Messages;

use Illuminate\Support\Facades\View;
use Konekt\Euplatesc\Dto\EuplatescAddress;
use Vanilo\Payment\Contracts\PaymentRequest;

class EuplatescPaymentRequest extends BaseMessage implements PaymentRequest
{
    /** @var  string    Order description (length (1-50)*/
    protected $orderDescription = '';

    /** @var  EuplatescAddress   The billing address */
    protected $billingAddress;

    /** @var  EuplatescAddress   The shipping address */
    protected $shippingAddress;

    /**
     * Returns the HTML form that can be rendered on frontend to submit payment request to Euplatesc
     *
     * @param array{autoRedirect:bool, buttonText:string} $options
     *
     * @return string|null
     */
    public function getHtmlSnippet(array $options = []): ?string
    {
        $buttonText = $options['buttonText'] ?? __('Pay safely');

        return View::make(
            'euplatesc::_request',
            [
                'paymentRequest' => $this,
                'buttonText'     => $buttonText,
                'autoRedirect'   => $options['autoRedirect'] ?? false
            ]
        )->render();
    }

    public function getOrderDescription(): string
    {
        return $this->orderDescription;
    }

    public function setOrderDescription(string $orderDescription): self
    {
        $this->orderDescription = $orderDescription;

        return $this;
    }

    public function getBillingAddress(): EuplatescAddress
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(EuplatescAddress $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    public function getShippingAddress(): EuplatescAddress
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(EuplatescAddress $shippingAddress): self
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    protected function getFpHashData(): array
    {
        return [
            'amount'     => $this->getAmountNumericFmt(),
            'curr'       => $this->getCurrency(),
            'invoice_id' => $this->getInvoiceId(),
            'order_desc' => $this->getOrderDescription(),
            'merch_id'   => $this->getMerchantId(),
            'timestamp'  => $this->getTimestamp(),
            'nonce'      => $this->getNonce(),
        ];
    }
}
