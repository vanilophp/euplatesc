# Euplatesc Installation

1. Add to your application via composer:
    ```bash
    composer require konekt/vanilo-euplatesc 
    ```
2. Add the module to `config/concord.php`:
    ```php
    <?php
    return [
        'modules' => [
             //...
             Konekt\Euplatesc\Providers\ModuleServiceProvider::class
             //...
        ]
    ]; 
    ```

## Registration with Payments Module

The module will register the payment gateway with the Vanilo Payments registry by default.

### Prevent from Auto-registration

If you don't want it to be registered automatically, you can prevent it by setting it in the module
configuration:

```php
//config/concord.php
return [
    'modules' => [
        //...
        Konekt\Euplatesc\Providers\ModuleServiceProvider::class => [
            'gateway' => [
                'register' => false
            ]
        ]
        //...
    ]
]; 
```

### Manual Registration

If you disable registration and want to register the gateway manually you can do it by using the
Vanilo Payment module's payment gateway registry:

```php
use Konekt\Euplatesc\EuplatescPaymentGateway;
use Vanilo\Payment\PaymentGateways;

PaymentGateways::register('gateway-id', EuplatescPaymentGateway::class);
```

---

**Next**: [Workflow &raquo;](workflow.md)
