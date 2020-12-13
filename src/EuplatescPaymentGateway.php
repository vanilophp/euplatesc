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

use Konekt\Euplatesc\Concerns\InteractsWithEuplatesc;
use Konekt\Euplatesc\Factories\RequestFactory;
use Vanilo\Contracts\Address;
use Vanilo\Contracts\Payable;
use Vanilo\Payment\Contracts\PaymentGateway;
use Vanilo\Payment\Contracts\PaymentRequest;

class EuplatescPaymentGateway implements PaymentGateway
{
    use InteractsWithEuplatesc;

    public const DEFAULT_ID = 'euplatesc';

    public static function getName(): string
    {
        return 'Euplatesc';
    }

    public function createPaymentRequest(
        Payable $payable,
        Address $shippingAddress = null,
        array $options = []
    ): PaymentRequest
    {
        return (new RequestFactory($this->merchantId, $this->encryptionKey))
            ->buildFromPayable($payable, $shippingAddress, $options);
    }

    public function isOffline(): bool
    {
        return false;
    }
}
