<?php

declare(strict_types=1);

/**
 * Contains the ResponseFactory class.
 *
 * @copyright   Copyright (c) 2020 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2020-12-26
 *
 */

namespace Vanilo\Euplatesc\Factories;

use Illuminate\Http\Request;
use Vanilo\Euplatesc\Concerns\InteractsWithEuplatesc;
use Vanilo\Euplatesc\Messages\EuplatescPaymentResponse;

class ResponseFactory
{
    use InteractsWithEuplatesc;

    public function buildFromCallbackRequest(Request $request, array $options = []): EuplatescPaymentResponse
    {
        $result = new EuplatescPaymentResponse($this->merchantId, $this->encryptionKey);

        $result->setAmount((float) $request->get('amount'))
            ->setCurrency($request->get('curr'))
            ->setInvoiceId($request->get('invoice_id'))
            ->setEpId($request->get('ep_id'))
            ->setAction(intval($request->get('action')))
            ->setMessage($request->get('message'))
            ->setApproval((string) $request->get('approval'))
            ->setTimestamp($request->get('timestamp'));

        return $result;
    }
}
