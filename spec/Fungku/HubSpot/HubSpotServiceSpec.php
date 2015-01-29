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

    function it_creates_a_blogs_api_class()
    {
        $this->blogs()->shouldHaveType('Fungku\HubSpot\Api\Blogs');
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

    function it_creates_a_forms_api_class()
    {
        $this->forms()->shouldHaveType('Fungku\HubSpot\Api\Forms');
    }

    function it_creates_a_keywords_api_class()
    {
        $this->keywords()->shouldHaveType('Fungku\HubSpot\Api\Keywords');
    }

    function it_creates_a_leadNurturing_api_class()
    {
        $this->leadNurturing()->shouldHaveType('Fungku\HubSpot\Api\LeadNurturing');
    }

    function it_creates_a_leads_api_class()
    {
        $this->leads()->shouldHaveType('Fungku\HubSpot\Api\Leads');
    }

    function it_creates_a_marketPlace_api_class()
    {
        $this->marketPlace()->shouldHaveType('Fungku\HubSpot\Api\MarketPlace');
    }

    function it_creates_a_settings_api_class()
    {
        $this->settings()->shouldHaveType('Fungku\HubSpot\Api\Settings');
    }

    function it_creates_a_socialMedia_api_class()
    {
        $this->socialMedia()->shouldHaveType('Fungku\HubSpot\Api\SocialMedia');
    }

    function it_creates_a_workflows_api_class()
    {
        $this->workflows()->shouldHaveType('Fungku\HubSpot\Api\Workflows');
    }

}
