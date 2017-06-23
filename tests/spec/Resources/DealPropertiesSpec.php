<?php

namespace spec\SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Tests\Helpers\SendsRequests;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DealPropertiesSpec extends ObjectBehavior
{

    use SendsRequests;

    function let(Client $client)
    {
        $this->beConstructedWith('demo', $client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SevenShores\Hubspot\Resources\DealProperties');
    }

    function it_can_create_a_deal_property($client)
    {
        $url = $this->buildUrl(' /properties/v1/deals/properties/');

        $property = [
            "name" => "shippingaddress",
            "label" => "Shipping Address",
            "description" => "The shipping address of the deal.",
            "groupName" => "dealinformation",
            "type" => "string",
            "fieldType" => "text",
            "formField" => true,
            "displayOrder" => 6,
            "options" => []
        ];

        $client->post($url, [
            'headers' => $this->headers,
            'json' => $property
        ])->shouldBeCalled()->willReturn('response');

        $this->create($property)->shouldReturn('response');
    }
}
