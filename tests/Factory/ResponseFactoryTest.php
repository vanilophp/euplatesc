<?php

declare(strict_types=1);

/**
 * Contains the ResponseFactoryTest class.
 *
 * @copyright   Copyright (c) 2020 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2020-12-26
 *
 */

namespace Konekt\Euplatesc\Tests\Factory;

use Illuminate\Http\Request;
use Konekt\Euplatesc\Factories\ResponseFactory;
use Konekt\Euplatesc\Messages\EuplatescPaymentResponse;
use Konekt\Euplatesc\Tests\TestCase;

class ResponseFactoryTest extends TestCase
{
    /** @test */
    public function it_creates_a_response_object()
    {
        $factory = new ResponseFactory('mid', 'some-key');

        $request = $this->mock(Request::class, function ($mock) {
            $mock->shouldReceive('get')
                ->andReturn('yo');
        });

        $this->assertInstanceOf(
            EuplatescPaymentResponse::class,
            $factory->buildFromCallbackRequest($request)
        );
    }
}
