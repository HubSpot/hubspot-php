<?php

namespace spec\SevenShores\Hubspot;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FactorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('make', ['demo']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SevenShores\Hubspot\HubSpotService');
    }

    function it_throws_a_hubspot_exception_from_uninstantiable_api_class()
    {
        $this->shouldThrow('\SevenShores\Hubspot\Exceptions\HubSpotException')->during('api');
    }

    function it_throws_a_reflection_exception_from_nonexistent_api_class()
    {
        $this->shouldThrow('\ReflectionException')->during('doesntExist');
    }

    function it_creates_a_blogs_api_class()
    {
        $this->blogs()->shouldHaveType('SevenShores\Hubspot\Api\Blogs');
    }

    function it_creates_a_blogAuthors_api_class()
    {
        $this->blogAuthors()->shouldHaveType('SevenShores\Hubspot\Api\BlogAuthors');
    }

    function it_creates_a_blogPosts_api_class()
    {
        $this->blogPosts()->shouldHaveType('SevenShores\Hubspot\Api\BlogPosts');
    }

    function it_creates_a_blogTopics_api_class()
    {
        $this->blogTopics()->shouldHaveType('SevenShores\Hubspot\Api\BlogTopics');
    }

    function it_creates_a_contacts_api_class()
    {
        $this->contacts()->shouldHaveType('SevenShores\Hubspot\Api\Contacts');
    }

    function it_creates_a_contactLists_api_class()
    {
        $this->contactLists()->shouldHaveType('SevenShores\Hubspot\Api\ContactLists');
    }

    function it_creates_a_contactProperties_api_class()
    {
        $this->contactProperties()->shouldHaveType('SevenShores\Hubspot\Api\ContactProperties');
    }

    function it_creates_a_email_api_class()
    {
        $this->email()->shouldHaveType('SevenShores\Hubspot\Api\Email');
    }

    function it_creates_a_emailEvents_api_class()
    {
        $this->emailEvents()->shouldHaveType('SevenShores\Hubspot\Api\EmailEvents');
    }

    function it_creates_a_files_api_class()
    {
        $this->files()->shouldHaveType('SevenShores\Hubspot\Api\Files');
    }

    function it_creates_a_forms_api_class()
    {
        $this->forms()->shouldHaveType('SevenShores\Hubspot\Api\Forms');
    }

    function it_creates_a_keywords_api_class()
    {
        $this->keywords()->shouldHaveType('SevenShores\Hubspot\Api\Keywords');
    }

    function it_creates_a_marketPlace_api_class()
    {
        $this->marketPlace()->shouldHaveType('SevenShores\Hubspot\Api\MarketPlace');
    }

    function it_creates_a_pages_api_class()
    {
        $this->pages()->shouldHaveType('SevenShores\Hubspot\Api\Pages');
    }

    function it_creates_a_socialMedia_api_class()
    {
        $this->socialMedia()->shouldHaveType('SevenShores\Hubspot\Api\SocialMedia');
    }

    function it_creates_a_workflows_api_class()
    {
        $this->workflows()->shouldHaveType('SevenShores\Hubspot\Api\Workflows');
    }

    function it_creates_an_events_api_class()
    {
        $this->events()->shouldHaveType('SevenShores\Hubspot\Api\Events');
    }

    function it_creates_a_company_properties_api_class()
    {
        $this->companyProperties()->shouldHaveType('SevenShores\Hubspot\Api\CompanyProperties');
    }
}
