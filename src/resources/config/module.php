<?php

declare(strict_types=1);

use Vanilo\Euplatesc\EuplatescPaymentGateway;

return [
    'gateway' => [
        'register' => true,
        'id' => EuplatescPaymentGateway::DEFAULT_ID
    ],
    'merchant_id' => env('EUPLATESC_MERCHANT_ID'),
    'encryption_key' => env('EUPLATESC_ENCRYPTION_KEY')
];
