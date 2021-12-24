<?php

declare(strict_types=1);

namespace SevenShores\Hubspot\Tests\unit\Exception;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;
use SevenShores\Hubspot\Exceptions\BadRequest;
use SevenShores\Hubspot\Exceptions\HubspotException;

/**
 * @internal
 * @coversNothing
 */
class HubspotExceptionTest extends TestCase
{
    public const EXAMPLE_TOKEN = '8907e60c-600d-4af8-a987-191c104a215c';

    /** @test */
    public function createExceptionFromGuzzleRequestException()
    {
        $e = new RequestException('Request Failed', new Request('GET', 'https://api.hubspot.com/x'));

        $hubspotException = HubspotException::create($e);

        $this->assertInstanceOf(HubspotException::class, $hubspotException);
        $this->assertNull($hubspotException->getResponse());
    }

    /** @test */
    public function createExceptionFromGuzzleClientException()
    {
        $e = ClientException::create(
            new Request(
                'GET',
                sprintf('https://api.hubapi.com/deals/v1/deal/12345?access_token=%s', static::EXAMPLE_TOKEN)
            ),
            new Response(
                400,
                [],
                Utils::streamFor('{"status":"error","message":"xyz"}')
            )
        );

        $hubspotException = BadRequest::create($e);

        $this->assertInstanceOf(BadRequest::class, $hubspotException);
        $this->assertStringNotContainsString(static::EXAMPLE_TOKEN, $hubspotException->getMessage());
        $this->assertSame($e->getResponse(), $hubspotException->getResponse());
        $this->assertSame('Client error: `GET https://api.hubapi.com/deals/v1/deal/12345?access_token=***` resulted in a `400 Bad Request` response:
{"status":"error","message":"xyz"}
', $hubspotException->getMessage());
    }

    /** @test */
    public function createExceptionFromGuzzleServerException()
    {
        $e = ServerException::create(
            new Request(
                'GET',
                sprintf('https://api.hubapi.com/deals/v1/deal/12345?hapikey=%s', static::EXAMPLE_TOKEN)
            ),
            new Response(
                502,
                [],
                Utils::streamFor('<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en-US"> <![endif]-->')
            )
        );

        $hubspotException = HubspotException::create($e);

        $this->assertInstanceOf(HubspotException::class, $hubspotException);
        $this->assertStringNotContainsString(static::EXAMPLE_TOKEN, $hubspotException->getMessage());
        $this->assertSame($e->getResponse(), $hubspotException->getResponse());
        $this->assertSame('Server error: `GET https://api.hubapi.com/deals/v1/deal/12345?hapikey=***` resulted in a `502 Bad Gateway` response:
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en-US"> <![endif]-->
', $hubspotException->getMessage());
    }
}
