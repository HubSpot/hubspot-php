<?php

namespace SevenShores\Hubspot\Tests\Unit\Utils;

use SevenShores\Hubspot\Utils;

/**
 * @internal
 * @coversNothing
 */
class WebhooksTest extends \PHPUnit\Framework\TestCase
{
    protected $secret = 'clientSecret';
    protected $requestBody = 'SomeBody';

    /** @test */
    public function validationHubspotSignatureValidData()
    {
        $result = Utils\Webhooks::isHubspotSignatureValid(
            hash('sha256', $this->secret.$this->requestBody),
            $this->secret,
            $this->requestBody
        );

        $this->assertEquals(
            true,
            $result
        );
    }

    /** @test */
    public function validationHubspotSignatureInvalidData()
    {
        $result = Utils\Webhooks::isHubspotSignatureValid(
            hash('sha256', $this->secret.$this->requestBody.'1'),
            $this->secret,
            $this->requestBody
        );

        $this->assertEquals(
            false,
            $result
        );
    }
}
