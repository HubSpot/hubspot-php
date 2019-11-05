<?php

namespace SevenShores\Hubspot\Tests\Unit\Utils;

use SevenShores\Hubspot\Utils;

class OAuth2Test extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function build_authorization_url()
    {
        $authUrl = Utils\OAuth2::getAuthUrl(
            'clientid',
            'http://localhost',
            ['contacts'],
            ['scope1,', 'scope2']
        );
        $this->assertEquals(
            'https://app.hubspot.com/oauth/authorize?client_id=clientid&redirect_uri=http%3A%2F%2Flocalhost&scope=contacts&optional_scope=scope1%2C+scope2',
            $authUrl
        );
    }
}
