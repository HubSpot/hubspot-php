<?php

namespace spec\Fungku\HubSpot\Api;

use Fungku\HubSpot\Http\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use tests\helpers\Fungku\HubSpot\SendsRequests;

class BlogPostsSpec extends ObjectBehavior
{
    use SendsRequests;

    function let(Client $client)
    {
        $this->client = $client;
        $this->beConstructedWith($this->apiKey, $this->client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\HubSpot\Api\BlogPosts');
    }

    function it_creates_a_blog_post()
    {
        $post = [
            'name'             => 'My Super Awesome Post ' . uniqid(),
            'content_group_id' => 351076997,
        ];

        $url = $this->buildUrl('/content/api/v2/blog-posts');

        $options = [
            'json' => $post,
            'headers' => $this->headers
        ];

        $this->client->post($url, $options)->shouldBeCalled();

        $this->create($post);
    }
}
