<?php

namespace SevenShores\Hubspot\Tests\Unit\Utils;

use SevenShores\Hubspot\Utils;

/**
 * @internal
 * @coversNothing
 */
class SignatureTest extends \PHPUnit\Framework\TestCase
{
    protected $secret = 'clientSecret';
    protected $requestBody = 'SomeBody';

    /** @test */
    public function validationHubspotSignatureValidData()
    {
        $result = Utils\Signature::isValid([
            'signature' => hash('sha256', $this->secret.$this->requestBody),
            'secret' => $this->secret,
            'requestBody' => $this->requestBody,
        ]);

        $this->assertEquals(
            true,
            $result
        );
    }

    /** @test */
    public function validationHubspotSignatureInvalidData()
    {
        $result = Utils\Signature::isValid([
            'signature' => hash('sha256', $this->secret.$this->requestBody.'1'),
            'secret' => $this->secret,
            'requestBody' => $this->requestBody,
        ]);

        $this->assertEquals(
            false,
            $result
        );
    }
}
