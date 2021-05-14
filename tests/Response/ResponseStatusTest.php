<?php

declare(strict_types=1);

/**
 * Contains the ResponseStatusTest class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-05-14
 *
 */

namespace Vanilo\Euplatesc\Tests\Response;

use Vanilo\Euplatesc\Messages\EuplatescPaymentResponse;
use Vanilo\Euplatesc\Models\EuplatescStatus;
use Vanilo\Euplatesc\Tests\TestCase;
use Vanilo\Payment\Models\PaymentStatus;

class ResponseStatusTest extends TestCase
{
    /** @test */
    public function action_0_means_it_was_successful()
    {
        $response = new EuplatescPaymentResponse('11225544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $response->setAction(0);

        $this->assertTrue($response->wasSuccessful());
    }

    /** @test */
    public function non_zero_action_means_it_was_not_successful()
    {
        $response = new EuplatescPaymentResponse('11225544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        foreach (range(1, 999) as $action) {
            $response->setAction($action);
            $this->assertFalse($response->wasSuccessful());
        }
    }

    /** @test */
    public function the_0_action_return_pending_ok_native_status()
    {
        $response = new EuplatescPaymentResponse('11225544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $response->setAction(0);
        $this->assertTrue($response->getNativeStatus()->equals(EuplatescStatus::PENDING_OK()));
    }

    /** @test */
    public function the_action_will_be_used_as_source_value_of_native_status()
    {
        $response = new EuplatescPaymentResponse('11225544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        foreach (EuplatescStatus::values() as $value) {
            $response->setAction($value);
            $nativeStatus = $response->getNativeStatus();
            $this->assertInstanceOf(EuplatescStatus::class, $nativeStatus);
            $this->assertEquals($value, $nativeStatus->value());
        }
    }

    /** @test */
    public function unknown_action_values_will_be_mapped_as_unknown_error_native_status()
    {
        $response = new EuplatescPaymentResponse('11225544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $response->setAction(32768);
        $this->assertTrue($response->getNativeStatus()->equals(EuplatescStatus::UNKNOWN_ERROR()));
    }

    /** @test */
    public function the_pending_ok_native_action_maps_to_authorized_status()
    {
        $response = new EuplatescPaymentResponse('11225544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $response->setAction(EuplatescStatus::PENDING_OK);
        $this->assertTrue($response->getStatus()->equals(PaymentStatus::AUTHORIZED()));
    }

    /** @test */
    public function the_transaction_expired_native_action_maps_to_timeout_status()
    {
        $response = new EuplatescPaymentResponse('11225544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $response->setAction(EuplatescStatus::TRANSACTION_EXPIRED);
        $this->assertTrue($response->getStatus()->equals(PaymentStatus::TIMEOUT()));
    }

    /** @test */
    public function the_transaction_already_captured_native_action_maps_to_paid_status()
    {
        $response = new EuplatescPaymentResponse('11225544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $response->setAction(EuplatescStatus::TRANSACTION_ALREADY_CAPTURED);
        $this->assertTrue($response->getStatus()->equals(PaymentStatus::PAID()));
    }

    /** @test */
    public function the_not_permitted_reversal_pending_native_action_maps_to_on_hold_status()
    {
        $response = new EuplatescPaymentResponse('11225544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $response->setAction(EuplatescStatus::NOT_PERMITTED_REVERSAL_PENDING);
        $this->assertTrue($response->getStatus()->equals(PaymentStatus::ON_HOLD()));
    }

    /** @test */
    public function all_other_actions_map_to_on_declined_status()
    {
        $response = new EuplatescPaymentResponse('11225544', '207a57f2d126d3dccb635c33850c7f85703ac43d');
        $mappedNativeStatues = [
            EuplatescStatus::PENDING_OK,
            EuplatescStatus::TRANSACTION_EXPIRED,
            EuplatescStatus::TRANSACTION_ALREADY_CAPTURED,
            EuplatescStatus::NOT_PERMITTED_REVERSAL_PENDING
        ];
        $nonMappedNativeStatuses = array_filter(
            EuplatescStatus::values(),
            fn($v, $k) => !in_array($v, $mappedNativeStatues),
            ARRAY_FILTER_USE_BOTH
        );

        foreach ($nonMappedNativeStatuses as $nativeStatus) {
            $response->setAction($nativeStatus);
            $this->assertTrue(
                $response->getStatus()->equals(PaymentStatus::DECLINED()),
                "Native status `$nativeStatus` is mapped to `{$response->getStatus()->value()}` instead of `declined`"
            );
        }
    }
}
