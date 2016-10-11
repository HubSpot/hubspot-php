<?php

namespace spec\SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Tests\Helpers\SendsRequests;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompaniesSpec extends ObjectBehavior
{
    use SendsRequests;

    function let(Client $client)
    {
        $this->beConstructedWith('demo', $client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SevenShores\Hubspot\Resources\Companies');
    }

    function it_can_create_a_new_company($client)
    {
        $properties = [
            [
                'name'  => 'name',
                'value' => 'A company name'
            ],
            [
                "name" => "description",
                "value" => "A company description"
            ]
        ];

        $url = $this->buildUrl('/companies/v2/companies/');

        $client->post($url,
            [
                'headers' => $this->headers,
                'json' => [
                    'properties' => $properties
                ]
            ])->shouldBeCalled()->willReturn('response');

        $this->create($properties)->shouldReturn('response');
    }

    function it_can_update_a_company($client)
    {
        $id = 10444744;
        $properties = [
            [
                'name' => 'description',
                'value' => 'A far better description than before'
            ]
        ];

        $url = $this->buildUrl("/companies/v2/companies/{$id}");

        $client->put($url,
            [
                'headers' => $this->headers,
                'json' => [
                    'properties' => $properties
                ]
            ])->shouldBeCalled()->willReturn('response');

        $this->update($id, $properties)->shouldReturn('response');
    }

    function it_can_delete_a_company($client)
    {
        $id = 10444744;

        $url = $this->buildUrl("/companies/v2/companies/{$id}");

        $client->delete($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->delete($id)->shouldReturn('response');
    }

    function it_can_get_all_companies($client)
    {
        $url = $this->buildUrl('/companies/v2/companies/paged');

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getRecentlyModified()->shouldReturn('response');
    }

    function it_can_get_recently_modified_companies($client)
    {
        $url = $this->buildUrl('/companies/v2/companies/recent/modified');

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getRecentlyModified()->shouldReturn('response');
    }

    function it_can_also_define_count_and_offset_for_recently_modified_companies($client)
    {
        $url = $this->buildUrl('/companies/v2/companies/recent/modified', '&offset=1&count=2');

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getRecentlyModified(['offset' => 1, 'count' => 2])->shouldReturn('response');
    }

    function it_can_get_recently_created_companies($client)
    {
        $url = $this->buildUrl('/companies/v2/companies/recent/created');

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getRecentlyCreated()->shouldReturn('response');

    }

    function it_can_also_define_count_and_offset_for_recently_created_companies($client)
    {
        $url = $this->buildUrl('/companies/v2/companies/recent/created', '&offset=1&count=2');

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getRecentlyCreated(['offset' => 1, 'count' => 2])->shouldReturn('response');
    }

    function it_can_get_companies_by_domain($client)
    {
        $domain = 'example.com';

        $url = $this->buildUrl("/companies/v2/companies/domain/{$domain}");

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getByDomain($domain)->shouldReturn('response');
    }

    function it_can_get_a_company_by_id($client)
    {
        $id = 10444744;

        $url = $this->buildUrl("/companies/v2/companies/{$id}");

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getById($id)->shouldReturn('response');
    }

    function it_can_add_contact_to_company($client)
    {
        $companyId = 1;
        $contactId = 2;

        $url = $this->buildUrl("/companies/v2/companies/{$companyId}/contacts/{$contactId}");

        $client->put($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->addContact($contactId, $companyId)->shouldReturn('response');
    }

    function it_can_get_contacts_associated_with_the_company($client)
    {
        $compnayId = 10444744;

        $url = $this->buildUrl("/companies/v2/companies/{$compnayId}/contacts");

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getAssociatedContacts($compnayId)->shouldReturn('response');
    }

    function it_can_also_define_count_and_vidOffset_for_associated_contacts($client)
    {
        $companyId = 10444744;

        $url = $this->buildUrl("/companies/v2/companies/{$companyId}/contacts", '&count=1&vidOffset=2');

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getAssociatedContacts($companyId, ['count' => 1, 'vidOffset' => 2])->shouldReturn('response');
    }

    function it_can_get_the_ids_of_the_contacts_associated_with_the_company($client)
    {
        $companyId = 10444744;

        $url = $this->buildUrl("/companies/v2/companies/{$companyId}/vids");

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getAssociatedContactIds($companyId)->shouldReturn('response');
    }

    function it_can_also_define_count_and_vidOffset_for_associated_contact_ids($client)
    {
        $companyId = 10444744;

        $url = $this->buildUrl("/companies/v2/companies/{$companyId}/vids", '&count=1&vidOffset=2');

        $client->get($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->getAssociatedContactIds($companyId,  ['count' => 1, 'vidOffset' => 2])->shouldReturn('response');
    }

    function it_can_remove_a_contact_from_a_company($client)
    {
        $companyId = 1;
        $contactId = 2;

        $url = $this->buildUrl("/companies/v2/companies/{$companyId}/contacts/{$contactId}");

        $client->delete($url, [
            'headers' => $this->headers
        ])->shouldBeCalled()->willReturn('response');

        $this->removeContact($contactId, $companyId)->shouldReturn('response');
    }

}
