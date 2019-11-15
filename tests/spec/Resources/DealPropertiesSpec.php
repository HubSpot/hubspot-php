<?php

namespace spec\SevenShores\Hubspot\Resources;

use PhpSpec\ObjectBehavior;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Tests\Helpers\SendsRequests;

class DealPropertiesSpec extends ObjectBehavior
{
    use SendsRequests;

    public function let(Client $client)
    {
        $this->beConstructedWith('demo', $client);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SevenShores\Hubspot\Resources\DealProperties');
    }
}
