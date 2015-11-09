<?php

namespace spec\Fungku\HubSpot\Api;

use Fungku\HubSpot\Http\Client;
use Fungku\HubSpot\Tests\Helpers\SendsRequests;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompaniesSpec extends ObjectBehavior
{
    use SendsRequests;

    function let(Client $client)
    {
        $this->beConstructedWith('demo', $client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\HubSpot\Api\Companies');
    }

    function it_can_create_a_new_company($client)
    {
        $properties = [
            [
                'name'  => 'name',
                'value' => 'A company name'
            ],
            [
                "name" => "description",
                "value" => "A company description"
            ]
        ];

        $url = $this->buildUrl('/companies/v2/companies/');

        $client->post($url,
            [
                'headers' => $this->headers,
                'json' => [
                    'properties' => $properties
                ]
            ])->shouldBeCalled()->willReturn('response');

        $this->create($properties)->shouldReturn('response');
    }

}
