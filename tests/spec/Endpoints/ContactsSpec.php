<?php

namespace spec\SevenShores\Hubspot\Endpoints;

use PhpSpec\ObjectBehavior;
use SevenShores\Hubspot\Http\Client;

class ContactsSpec extends ObjectBehavior
{
    private $client;

    private $apiKey = 'demo';

    private $baseUrl = 'https://api.hubapi.com';

    private $headers = [
        'User-Agent' => 'Fungku_HubSpot_PHP/0.9 (https://github.com/fungku/hubspot-php)',
    ];

    public function let(Client $client)
    {
        $this->beConstructedWith('demo', $client);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SevenShores\Hubspot\Endpoints\Contacts');
    }

    private function getUrl($endpoint)
    {
        return $this->baseUrl.$endpoint.'?hapikey='.$this->apiKey;
    }
}
