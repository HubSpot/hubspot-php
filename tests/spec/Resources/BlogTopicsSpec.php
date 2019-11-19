<?php

namespace spec\SevenShores\Hubspot\Resources;

use PhpSpec\ObjectBehavior;
use SevenShores\Hubspot\Http\Client;

class BlogTopicsSpec extends ObjectBehavior
{
    public function let(Client $client)
    {
        $this->beConstructedWith('demo', $client);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SevenShores\Hubspot\Resources\BlogTopics');
    }
}
