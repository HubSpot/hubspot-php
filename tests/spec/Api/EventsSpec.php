<?php

namespace spec\Fungku\HubSpot\Api;

use Fungku\HubSpot\Http\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventsSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->client = $client;
        $this->beConstructedWith($this->apiKey, $this->client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\HubSpot\Api\Events');
    }
}
