<form action="https://secure.euplatesc.ro/tdsprocess/tranzactd.php" method="POST" name="gateway" target="_self" style="display: inline">
    @if($autoRedirect)
        <p>{{ __('You will be redirected to the secure payment page') }}</p>
        <p class="text-center">
            <img src="https://www.euplatesc.ro/plati-online/tdsprocess/images/progress.gif" alt="" title=""
                 onload="javascript:document.gateway.submit()">
        </p>
    @endif

    <?php $billingAddress = $paymentRequest->getBillingAddress(); ?>

    <input name="fname" type="hidden" value="{{ $billingAddress->getFirstName() }}"/>
    <input name="lname" type="hidden" value="{{ $billingAddress->getLastName() }}"/>
    <input name="country" type="hidden" value="{{ $billingAddress->getCountry() }}"/>
    <input name="state" type="hidden" value="{{ $billingAddress->getState() }}"/>
    <input name="company" type="hidden" value="{{ $billingAddress->getCompany() }}"/>
    <input name="city" type="hidden" value="{{ $billingAddress->getCity() }}"/>
    <input name="zip" type="hidden" value="{{ $billingAddress->getZip() }}"/>
    <input name="add" type="hidden" value="{{ $billingAddress->getAddress() }}"/>
    <input name="email" type="hidden" value="{{ $billingAddress->getEmail() }}"/>
    <input name="phone" type="hidden" value="{{ $billingAddress->getPhone() }}"/>
    <input name="fax" type="hidden" value="{{ $billingAddress->getCity() }}"/>

    <?php $shippingAddress = $paymentRequest->getShippingAddress(); ?>

    <input name="sfname" type="hidden" value="{{ $shippingAddress->getFirstName() }}"/>
    <input name="slname" type="hidden" value="{{ $shippingAddress->getLastName() }}"/>
    <input name="scountry" type="hidden" value="{{ $shippingAddress->getCountry() }}"/>
    <input name="sstate" type="hidden" value="{{ $shippingAddress->getState() }}"/>
    <input name="scompany" type="hidden" value="{{ $shippingAddress->getCompany() }}"/>
    <input name="scity" type="hidden" value="{{ $shippingAddress->getCity() }}"/>
    <input name="szip" type="hidden" value="{{ $shippingAddress->getZip() }}"/>
    <input name="sadd" type="hidden" value="{{ $shippingAddress->getAddress() }}"/>
    <input name="semail" type="hidden" value="{{ $shippingAddress->getEmail() }}"/>
    <input name="sphone" type="hidden" value="{{ $shippingAddress->getPhone() }}"/>
    <input name="sfax" type="hidden" value="{{ $shippingAddress->getCity() }}"/>

    <input type="hidden" name="amount" value="{{ $paymentRequest->getAmountNumericFmt() }}"/>
    <input type="hidden" name="curr" value="{{ $paymentRequest->getCurrency() }}"/>
    <input type="hidden" name="invoice_id" value="{{ $paymentRequest->getInvoiceId() }}"/>
    <input type="hidden" name="order_desc" value="{{ $paymentRequest->getOrderDescription() }}"/>
    <input type="hidden" name="merch_id" value="{{ $paymentRequest->getMerchantId() }}"/>
    <input type="hidden" name="timestamp" value="{{ $paymentRequest->getTimestamp() }}"/>
    <input type="hidden" name="nonce" value="{{ $paymentRequest->getNonce() }}"/>
    <input type="hidden" name="fp_hash" value="{{ $paymentRequest->getFpHash() }}"/>

    <a href="javascript:gateway.submit();" class="btn btn-primary">{{ $buttonText }}</a>

</form>
