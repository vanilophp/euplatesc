<?php
/**
 * Contains the BaseMessage class.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Konekt\Euplatesc\Messages;

use Konekt\Euplatesc\Concerns\InteractsWithEuplatesc;

abstract class BaseMessage
{
    use InteractsWithEuplatesc;

    protected $amount;

    /** @var  string    The currency of the transaction (EUR, USD, RON) */
    protected $currency;

    /** @var  string    Merchant order/invoice ID (length: 6-27) */
    protected $invoiceId;

    /** @var  string    Merchant transaction timestamp in GMT: YYYYMMDDHHMMSS (length 14) */
    protected $timestamp;

    /** @var  string    Merchant nonce. Must be filled with unpredictable random bytes in hexadecimal format (length 16-64) */
    protected $nonce;

    /** @var  string    Merchant MAC in hexadecimal form (length 1-256) */
    protected $fpHash;

    /** @var  string    Additional information sent by the mechant to the gateway.
     *                  This data will be posted back to the merchant during silent_reply
     *                  (length 0-10240)
     */
    protected $extraData;

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Returns the amount's value (numeric) part
     *
     * @param string $decimalSeparator
     * @return string
     */
    public function getAmountNumericFmt(string $decimalSeparator = '.'): string
    {
        if (!$this->getAmount()) {
            return '';
        }

        $operationUnit = $this->getAmount();
        if (floor($operationUnit) == $operationUnit) {
            $decimalNumber = 0;
        } else {
            $decimalNumber = 2;
        }

        return number_format($operationUnit, $decimalNumber, $decimalSeparator, '');
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(string $invoiceId): self
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    public function getExtraData(): string
    {
        return $this->extraData;
    }

    public function setExtraData(string $extraData): self
    {
        $this->extraData = $extraData;

        return $this;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function getTimestamp(): string
    {
        if (!$this->timestamp) {
            $this->timestamp = gmdate("YmdHis");
        }

        return $this->timestamp;
    }

    public function getNonce(): string
    {
        if (!$this->nonce) {
            $this->nonce = md5(microtime() . mt_rand());
        }

        return $this->nonce;
    }

    public function getFpHash(): string
    {
        if (!$this->fpHash) {
            $this->fpHash = $this->calculateFpHash($this->getFpHashData(), $this->encryptionKey);
        }

        return $this->fpHash;
    }

    /**
     * Returns the data array necessary for calculating the fp hash
     */
    abstract protected function getFpHashData(): array;

    /**
     * Calculates the fp hash
     *
     * @param array     $data   key/value array with source data
     * @param string    $key    Encryption key assigned to the account
     *
     * @return string
     */
    protected function calculateFpHash(array $data, string $key)
    {
        return strtoupper(Hash::euplatescMac($data, $key));
    }
}
