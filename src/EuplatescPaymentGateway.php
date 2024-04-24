<?php

declare(strict_types=1);

/**
 * Contains the EuplatescPaymentGateway class.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Vanilo\Euplatesc;

use Illuminate\Http\Request;
use Vanilo\Contracts\Address;
use Vanilo\Euplatesc\Concerns\InteractsWithEuplatesc;
use Vanilo\Euplatesc\Factories\RequestFactory;
use Vanilo\Euplatesc\Factories\ResponseFactory;
use Vanilo\Payment\Contracts\Payment;
use Vanilo\Payment\Contracts\PaymentGateway;
use Vanilo\Payment\Contracts\PaymentRequest;
use Vanilo\Payment\Contracts\PaymentResponse;
use Vanilo\Payment\Contracts\TransactionHandler;

class EuplatescPaymentGateway implements PaymentGateway
{
    private static ?string $svg = null;

    use InteractsWithEuplatesc;

    public const DEFAULT_ID = 'euplatesc';

    public static function getName(): string
    {
        return 'Euplatesc';
    }

    public static function svgIcon(): string
    {
        return self::$svg ??= file_get_contents(__DIR__ . '/../../resources/euplatesc.svg');
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

    public function transactionHandler(): ?TransactionHandler
    {
        return null;
    }

    public function isOffline(): bool
    {
        return false;
    }
}
