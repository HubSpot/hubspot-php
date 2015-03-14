<?php

namespace spec\Fungku\HubSpot\Api;

use Fungku\HubSpot\Http\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContactsSpec extends ObjectBehavior
{
    private $client;

    function let(Client $client)
    {
        $this->client = $client;
        $this->beConstructedWith('demo', $client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\HubSpot\Api\Contacts');
    }

    //function it_creates_a_contact()
    //{
    //    $contact = [
    //        'properties' => [
    //            [
    //                'property' => 'email',
    //                'value' => 'apitest@hubspot.com'
    //            ],
    //            [
    //                'property' => 'firstname',
    //                'value' => 'hubspot'
    //            ],
    //            [
    //                'property' => 'lastname',
    //                'value' => 'user'
    //            ],
    //            [
    //                'property' => 'phone',
    //                'value' => '555-1212'
    //            ],
    //        ]
    //    ];
    //}
}
