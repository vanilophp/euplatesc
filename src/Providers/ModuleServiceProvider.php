<?php
/**
 * Contains the ModuleServiceProvider class.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Konekt\Euplatesc\Providers;

use Konekt\Concord\BaseModuleServiceProvider;
use Konekt\Euplatesc\EuplatescPaymentGateway;
use RuntimeException;
use Vanilo\Payment\PaymentGateways;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    public function boot()
    {
        parent::boot();

        if ($this->config('gateway.register', true)) {
            PaymentGateways::register(
                $this->config('gateway.id', EuplatescPaymentGateway::DEFAULT_ID),
                EuplatescPaymentGateway::class
            );
        }

        $this->app->bind(EuplatescPaymentGateway::class, function ($app) {
            $mid = $this->config('merchant_id');
            $key = $this->config('encryption_key');

            if (is_null($mid) || is_null($key)) {
                throw new RuntimeException(
                    'Can not create Euplatesc gateway, either merchant_id or encryption_key is not configured.'
                );
            }

            return new EuplatescPaymentGateway(
                $this->config('merchant_id'),
                $this->config('encryption_key')
            );
        });
    }
}
