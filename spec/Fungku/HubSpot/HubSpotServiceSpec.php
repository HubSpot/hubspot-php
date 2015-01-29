<?php

namespace spec\Fungku\HubSpot;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HubSpotServiceSpec extends ObjectBehavior
{
    private $apiKey = "demo";

    function let()
    {
        $this->beConstructedThrough('make', [$this->apiKey]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\HubSpot\HubSpotService');
    }

    function it_creates_a_contacts_api_class()
    {
        $this->contacts()->shouldHaveType('Fungku\HubSpot\Api\Contacts');
    }

    function it_creates_a_blogs_api_class()
    {
        $this->blogs()->shouldHaveType('Fungku\HubSpot\Api\Blogs');
    }
}
