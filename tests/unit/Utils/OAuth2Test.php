<?php

namespace SevenShores\Hubspot\Tests\Unit\Utils;

use SevenShores\Hubspot\Utils;

/**
 * @internal
 * @coversNothing
 */
class OAuth2Test extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function buildAuthorizationUrl()
    {
        $authUrl = Utils\OAuth2::getAuthUrl(
            'clientid',
            'http://localhost',
            ['contacts', 'timeline'],
            ['scope1', 'scope2']
        );
        $this->assertEquals(
            'https://app.hubspot.com/oauth/authorize?client_id=clientid&redirect_uri=http%3A%2F%2Flocalhost&scope=contacts%20timeline&optional_scope=scope1%20scope2',
            $authUrl
        );
    }
}
