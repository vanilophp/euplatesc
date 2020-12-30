<?php
/**
 * Contains the EuplatescPaymentGateway class.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Konekt\Euplatesc;

use Illuminate\Http\Request;
use Konekt\Euplatesc\Concerns\InteractsWithEuplatesc;
use Konekt\Euplatesc\Factories\RequestFactory;
use Konekt\Euplatesc\Factories\ResponseFactory;
use Vanilo\Contracts\Address;
use Vanilo\Payment\Contracts\Payment;
use Vanilo\Payment\Contracts\PaymentGateway;
use Vanilo\Payment\Contracts\PaymentRequest;
use Vanilo\Payment\Contracts\PaymentResponse;

class EuplatescPaymentGateway implements PaymentGateway
{
    use InteractsWithEuplatesc;

    public const DEFAULT_ID = 'euplatesc';

    public static function getName(): string
    {
        return 'Euplatesc';
    }

    public function createPaymentRequest(
        Payment $payment,
        Address $shippingAddress = null,
        array $options = []
    ): PaymentRequest {
        return (new RequestFactory($this->merchantId, $this->encryptionKey))
            ->buildFromPayment($payment, $shippingAddress, $options);
    }

    public function processPaymentResponse(Request $request, array $options = []): PaymentResponse
    {
        return (new ResponseFactory($this->merchantId, $this->encryptionKey))
            ->buildFromCallbackRequest($request, $options);
    }

    public function isOffline(): bool
    {
        return false;
    }
}
