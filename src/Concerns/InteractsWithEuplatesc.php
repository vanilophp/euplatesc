<?php
/**
 * Contains the InteractsWithEuplatesc trait.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Vanilo\Euplatesc\Concerns;

trait InteractsWithEuplatesc
{
    /** @var null|string Merchant ID assigned by EuPlatesc.ro (length 8-50) */
    private $merchantId;

    /** @var null|string The encryption key (assigned to the account) */
    private $encryptionKey;

    public function __construct(?string $merchantId, ?string $encryptionKey)
    {
        $this->merchantId    = $merchantId;
        $this->encryptionKey = $encryptionKey;
    }

    public function isProperlyConfigured(): bool
    {
        if (null === $this->merchantId || null === $this->encryptionKey) {
            return false;
        }

        return true;
    }
}
