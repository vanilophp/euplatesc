# Euplatesc Payment Workflow

## Simple Gateway Usage

**Controller:**

```php
use Vanilo\Payment\PaymentGateways;

class OrderController
{
    public function submit(CreateOrderRequest $request)
    {
        $order = Order::createFrom($request);
        $gateway = PaymentGateways::make('euplatesc');
        $paymentRequest = $gateway->createPaymentRequest($order);
        
        return view('order.confirmation', [
            'order' => $order,
            'paymentRequest' => $paymentRequest
        ]);
    }
}
```

**Blade Template:**

```blade
{!! $request->getHtmlSnippet(); !!}
```

---

**Next**: [Examples &raquo;](examples.md)
