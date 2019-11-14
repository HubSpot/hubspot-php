<?php

namespace spec\SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Tests\Helpers\SendsRequests;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompanyPropertiesSpec extends ObjectBehavior
{
    use SendsRequests;

    public function let(Client $client)
    {
        $this->beConstructedWith('demo', $client);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SevenShores\Hubspot\Resources\CompanyProperties');
    }
}
