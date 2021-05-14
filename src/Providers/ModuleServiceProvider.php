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

namespace Vanilo\Euplatesc\Providers;

use Konekt\Concord\BaseModuleServiceProvider;
use Vanilo\Euplatesc\EuplatescPaymentGateway;
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
            return new EuplatescPaymentGateway(
                $this->config('merchant_id'),
                $this->config('encryption_key')
            );
        });
    }
}
