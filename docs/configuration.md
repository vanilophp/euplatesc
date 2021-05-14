# Configuration

## Merchant ID & Encryption Key

There are two mandatory parameters for euplatesc operations:
- merchant id
- encryption key.

These settings can be found in your [euplatesc account](https://manager.euplatesc.ro/v2/admin/)
under Admin -> Gestionare cont as "ID Cont" (merchant id) and "Cheie" (encryption key).

To set these values in your application add the values to your application's `.env` file:

```dotenv
EUPLATESC_MERCHANT_ID=49998887770
EUPLATESC_ENCRYPTION_KEY=170aaaabbbbccccddddeeeeffff0000111122220
```

## Using a Custom Gateway ID

The gateway gets registered with the default id (`euplatesc`) but you can change this id from within
the module configuration:

```php
//config/concord.php
return [
    'modules' => [
        //...
        Vanilo\Euplatesc\Providers\ModuleServiceProvider::class => [
            'gateway' => [
                'register' => true,
                'id' => 'my-fancier-than-yours-gateway-id'
            ]
        ]
        //...
    ]
]; 
```
