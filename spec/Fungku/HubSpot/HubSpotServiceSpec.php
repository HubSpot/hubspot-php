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

    function it_throws_a_hubspot_exception_from_uninstantiable_api_class()
    {
        $this->shouldThrow('\Fungku\HubSpot\Exceptions\HubSpotException')->during('api');
    }

    function it_throws_a_reflection_exception_from_nonexistent_api_class()
    {
        $this->shouldThrow('\ReflectionException')->during('doesntExist');
    }

    function it_creates_a_blogs_api_class()
    {
        $this->blogs()->shouldHaveType('Fungku\HubSpot\Api\Blogs');
    }

    function it_creates_a_blogPosts_api_class()
    {
        $this->blogPosts()->shouldHaveType('Fungku\HubSpot\Api\BlogPosts');
    }

    function it_creates_a_contacts_api_class()
    {
        $this->contacts()->shouldHaveType('Fungku\HubSpot\Api\Contacts');
    }

    function it_creates_a_contactLists_api_class()
    {
        $this->contactLists()->shouldHaveType('Fungku\HubSpot\Api\ContactLists');
    }

    function it_creates_a_contactProperties_api_class()
    {
        $this->contactProperties()->shouldHaveType('Fungku\HubSpot\Api\ContactProperties');
    }

    function it_creates_a_email_api_class()
    {
        $this->email()->shouldHaveType('Fungku\HubSpot\Api\Email');
    }

    function it_creates_a_emailEvents_api_class()
    {
        $this->emailEvents()->shouldHaveType('Fungku\HubSpot\Api\EmailEvents');
    }

    function it_creates_a_files_api_class()
    {
        $this->files()->shouldHaveType('Fungku\HubSpot\Api\Files');
    }

    function it_creates_a_forms_api_class()
    {
        $this->forms()->shouldHaveType('Fungku\HubSpot\Api\Forms');
    }

    function it_creates_a_keywords_api_class()
    {
        $this->keywords()->shouldHaveType('Fungku\HubSpot\Api\Keywords');
    }

    function it_creates_a_marketPlace_api_class()
    {
        $this->marketPlace()->shouldHaveType('Fungku\HubSpot\Api\MarketPlace');
    }

    function it_creates_a_pages_api_class()
    {
        $this->pages()->shouldHaveType('Fungku\HubSpot\Api\Pages');
    }

    function it_creates_a_socialMedia_api_class()
    {
        $this->socialMedia()->shouldHaveType('Fungku\HubSpot\Api\SocialMedia');
    }

    function it_creates_a_workflows_api_class()
    {
        $this->workflows()->shouldHaveType('Fungku\HubSpot\Api\Workflows');
    }

    function it_creates_an_events_api_class()
    {
        $this->events()->shouldHaveType('Fungku\HubSpot\Api\Events');
    }
}
