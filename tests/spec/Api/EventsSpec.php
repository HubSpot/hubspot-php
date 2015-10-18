<?php

namespace spec\Fungku\HubSpot\Api;

use Fungku\HubSpot\Http\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use tests\helpers\Fungku\HubSpot\SendsRequests;

class EventsSpec extends ObjectBehavior
{
    use SendsRequests;

    function let(Client $client)
    {
        $this->client = $client;
        $this->beConstructedWith($this->apiKey, $this->client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\HubSpot\Api\Events');
    }

    function it_triggers()
    {
        $this->client->get(
            'http://track.hubspot.com/v1/event?_a=56043&_n=917',
            ['headers' => $this->headers]
        )->shouldBeCalled();

        $this->trigger(56043, 917);
    }

    function it_triggers_with_email()
    {
        $this->client->get(
            'http://track.hubspot.com/v1/event?_a=56043&_n=917&email=test%40hubspot.com',
            ['headers' => $this->headers]
        )->shouldBeCalled();

        $this->trigger(56043, 917, 'test@hubspot.com');
    }

    function it_triggers_with_revenue()
    {
        $this->client->get(
            'http://track.hubspot.com/v1/event?_a=56043&_n=917&email=test%40hubspot.com&_m=50',
            ['headers' => $this->headers]
        )->shouldBeCalled();

        $this->trigger(56043, 917, 'test@hubspot.com', 50);
    }

    function it_triggers_with_properties()
    {
        $this->client->get(
            'http://track.hubspot.com/v1/event?_a=56043&_n=917&firstname=joe&email=test%40hubspot.com&_m=50',
            ['headers' => $this->headers]
        )->shouldBeCalled();

        $this->trigger(56043, 917, 'test@hubspot.com', 50, ['firstname' => 'joe']);
    }
}
