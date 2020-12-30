<?php

declare(strict_types=1);

/**
 * Contains the EuplatescPaymentResponse class.
 *
 * @copyright   Copyright (c) 2020 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2020-12-26
 *
 */

namespace Konekt\Euplatesc\Messages;

use Vanilo\Payment\Contracts\PaymentResponse;

class EuplatescPaymentResponse extends BaseMessage implements PaymentResponse
{
    /** @var  string    Gateway unique id for each transaction. (length 1-50) */
    protected $epId;

    /** @var  int       If 0 – transaction approved else transaction failed. */
    protected $action;

    /** @var  string    Response code text message. (length 1-50) */
    protected $message;

    /** @var  string    Client bank’s approval code. Can be empty if not provided by gateway. length (0-6) */
    protected $approval;

    public function wasSuccessful(): bool
    {
        return 0 === $this->getAction();
    }

    public function getAmountPaid(): ?float
    {
        return floatval($this->getAmount());
    }

    public function getPaymentId(): string
    {
        return $this->invoiceId;
    }

    public function getTransactionId(): ?string
    {
        return $this->epId;
    }

    public function getEpId(): string
    {
        return $this->epId;
    }

    public function getAction(): int
    {
        return $this->action;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getApproval(): string
    {
        return $this->approval;
    }

    public function setEpId(string $epId): self
    {
        $this->epId = $epId;

        return $this;
    }

    public function setAction(int $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setApproval(string $approval): self
    {
        $this->approval = $approval;

        return $this;
    }

    public function setTimestamp(string $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getFpHashData(): array
    {
        return [
            'amount'     => addslashes(trim($this->getAmount()->getAmount())),          //original amount
            'curr'       => addslashes(trim($this->getAmount()->getCurrency()->getCode())), //original currency
            'invoice_id' => addslashes(trim($this->getInvoiceId())),                    //original invoice id
            'ep_id'      => addslashes(trim($this->getEpId())),                         //Euplatesc.ro unique id
            'merch_id'   => addslashes(trim($this->getMerchantId())),                   //your merchant id
            'action'     => addslashes(trim($this->getAction())),                       // if action ==0 transaction ok
            'message'    => addslashes(trim($this->getMessage())),                      // transaction response message
            'approval'   => addslashes(trim($this->getApproval())),                     // if action!=0 empty
            'timestamp'  => addslashes(trim($this->getTimestamp())),                    // message timestamp
            'nonce'      => addslashes(trim($this->getNonce())),
        ];
    }
}
