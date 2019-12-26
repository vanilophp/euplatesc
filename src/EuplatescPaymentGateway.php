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

use Vanilo\Contracts\Payable;
use Vanilo\Payment\Contracts\PaymentGateway;
use Vanilo\Payment\Contracts\PaymentRequest;

class EuplatescPaymentGateway implements PaymentGateway
{
    public const DEFAULT_ID = 'euplatesc';

    public static function getName(): string
    {
        return 'Euplatesc';
    }

    public function createPaymentRequest(Payable $payable): PaymentRequest
    {
        // TODO: Implement createPaymentRequest() method.
    }

    public function isOffline(): bool
    {
        return false;
    }
}
