<?php

namespace spec\SevenShores\Hubspot;

use PhpSpec\ObjectBehavior;

class FactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedThrough('create', ['demo']);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SevenShores\Hubspot\HubspotClientFactory');
    }

    public function it_creates_a_blogs_api_class()
    {
        $this->blogs()->shouldHaveType('SevenShores\Hubspot\Resources\Blogs');
    }

    public function it_creates_a_blogAuthors_api_class()
    {
        $this->blogAuthors()->shouldHaveType('SevenShores\Hubspot\Resources\BlogAuthors');
    }

    public function it_creates_a_blogPosts_api_class()
    {
        $this->blogPosts()->shouldHaveType('SevenShores\Hubspot\Resources\BlogPosts');
    }

    public function it_creates_a_blogTopics_api_class()
    {
        $this->blogTopics()->shouldHaveType('SevenShores\Hubspot\Resources\BlogTopics');
    }

    public function it_creates_a_contacts_api_class()
    {
        $this->contacts()->shouldHaveType('SevenShores\Hubspot\Resources\Contacts');
    }

    public function it_creates_a_contactLists_api_class()
    {
        $this->contactLists()->shouldHaveType('SevenShores\Hubspot\Resources\ContactLists');
    }

    public function it_creates_a_contactProperties_api_class()
    {
        $this->contactProperties()->shouldHaveType('SevenShores\Hubspot\Resources\ContactProperties');
    }

    public function it_creates_a_email_api_class()
    {
        $this->emailSubscription()->shouldHaveType('SevenShores\Hubspot\Resources\EmailSubscription');
    }

    public function it_creates_a_emailEvents_api_class()
    {
        $this->emailEvents()->shouldHaveType('SevenShores\Hubspot\Resources\EmailEvents');
    }

    public function it_creates_a_files_api_class()
    {
        $this->files()->shouldHaveType('SevenShores\Hubspot\Resources\Files');
    }

    public function it_creates_a_forms_api_class()
    {
        $this->forms()->shouldHaveType('SevenShores\Hubspot\Resources\Forms');
    }

    public function it_creates_a_keywords_api_class()
    {
        $this->keywords()->shouldHaveType('SevenShores\Hubspot\Resources\Keywords');
    }

    public function it_creates_a_pages_api_class()
    {
        $this->pages()->shouldHaveType('SevenShores\Hubspot\Resources\Pages');
    }

    public function it_creates_a_socialMedia_api_class()
    {
        $this->socialMedia()->shouldHaveType('SevenShores\Hubspot\Resources\SocialMedia');
    }

    public function it_creates_a_workflows_api_class()
    {
        $this->workflows()->shouldHaveType('SevenShores\Hubspot\Resources\Workflows');
    }

    public function it_creates_an_events_api_class()
    {
        $this->events()->shouldHaveType('SevenShores\Hubspot\Resources\Events');
    }

    public function it_creates_a_company_properties_api_class()
    {
        $this->companyProperties()->shouldHaveType('SevenShores\Hubspot\Resources\CompanyProperties');
    }
}
