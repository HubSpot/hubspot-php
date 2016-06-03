<?php

namespace spec\SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Tests\Helpers\SendsRequests;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompanyPropertiesSpec extends ObjectBehavior
{

    use SendsRequests;

    function let(Client $client)
    {
        $this->beConstructedWith('demo', $client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SevenShores\Hubspot\Resources\CompanyProperties');
    }

    function it_can_create_a_company_property($client)
    {
        $url = $this->buildUrl('/companies/v2/properties/');

        $property = [
            "name" => "shippingaddress",
            "label" => "Shipping Address",
            "description" => "The shipping address of the company.",
            "groupName" => "companyinformation",
            "type" => "string",
            "fieldType" => "text",
            "formField" => true,
            "displayOrder" => 6,
            "options" => []
        ];

        $client->post($url, [
            'headers' => $this->headers,
            'json' => $property
        ])->shouldBeCalled()->willReturn('response');

        $this->create($property)->shouldReturn('response');
    }

    function it_can_update_a_company_property($client)
    {
        $propertyName = 'shippingaddress';

        $url = $this->buildUrl("/companies/v2/properties/named/{$propertyName}");

        $property = [
            "label" => "Shipping Address",
            "description" => "The shipping address of the company.",
            "groupName" => "companyinformation",
            "type" => "string",
            "fieldType" => "text",
            "formField" => true,
            "displayOrder" => 6,
            "options" => []
        ];

        $jsonProperty = $property;
        $jsonProperty['name'] = $propertyName;

        $client->put($url, [
            'headers' => $this->headers,
            'json' => $jsonProperty
        ])->shouldBeCalled()->willReturn('response');

        $this->update($propertyName, $property)->shouldReturn('response');
    }

    function it_can_delete_a_company_property($client)
    {
        $propertyName = 'shippingaddress';

        $url = $this->buildUrl("/companies/v2/properties/named/{$propertyName}");

        $client->delete($url, ['headers' => $this->headers])
            ->shouldBeCalled()
            ->willReturn('response');

        $this->delete($propertyName)->shouldReturn('response');

    }

    function it_can_get_a_company_property($client)
    {
        $propertyName = 'shippingaddress';

        $url = $this->buildUrl("/companies/v2/properties/named/{$propertyName}");

        $client->get($url, ['headers' => $this->headers])
            ->shouldBeCalled()
            ->willReturn('response');

        $this->get($propertyName)->shouldReturn('response');
    }

    function it_can_get_all_company_properties($client)
    {
        $url = $this->buildUrl("/companies/v2/properties/");

        $client->get($url, ['headers' => $this->headers])
            ->shouldBeCalled()
            ->willReturn('response');

        $this->all()->shouldReturn('response');
    }

    function it_can_create_a_company_property_group($client)
    {
        $url = $this->buildUrl('/companies/v2/groups/');

        $group = [
            "name" => "anewcustomgroup",
            "displayName" => "A New Custom Group",
            "displayOrder" => 6,
            "properties" => [
                'description' => "A company's shipping address",
                'label' => 'ShippingAddress',
                'fieldType' => 'text',
                'formField' => True,
                'type' => 'string',
                'options' => [],
                'displayOrder' => 0,
                'name' => 'shippingaddress'
            ]
        ];

        $client->post($url,[
            'headers' => $this->headers,
            'json' => $group
        ])->shouldBeCalled()->willReturn('response');

        $this->createGroup($group)->shouldReturn('response');
    }

    function it_can_update_a_company_property_group($client)
    {
        $propertyGroupName = "acustomcompanygroup";

        $url = $this->buildUrl("/companies/v2/groups/named/{$propertyGroupName}");

        $group = [
            "displayName" => "An Updated Company Property Group",
            "displayOrder" => 6,
            "properties" => []
        ];

        $jsonGroup = $group;
        $jsonGroup['name'] = $propertyGroupName;

        $client->put($url, [
            'headers' => $this->headers,
            'json' => $jsonGroup
        ])->shouldBeCalled()->willReturn('response');

        $this->updateGroup($propertyGroupName, $group)->shouldReturn('response');
    }

    function it_can_delete_company_property_group($client)
    {
        $propertyGroupName = "acustomcompanygroup";

        $url = $this->buildUrl("/companies/v2/groups/named/{$propertyGroupName}");

        $client->delete($url, ['headers' => $this->headers])
            ->shouldBeCalled()
            ->willReturn('response');

        $this->deleteGroup($propertyGroupName)->shouldReturn('response');
    }

    function it_can_get_all_company_property_groups($client)
    {
        $url = $this->buildUrl('/companies/v2/groups/');

        $client->get($url, ['headers' => $this->headers])
            ->shouldBeCalled()
            ->willReturn('response');

        $this->getAllGroups()->shouldReturn('response');
    }

    function it_can_get_all_company_property_groups_with_properties($client)
    {
        $url = $this->buildUrl('/companies/v2/groups/', '&includeProperties=true');

        $client->get($url, ['headers' => $this->headers])
            ->shouldBeCalled()
            ->willReturn('response');

        $this->getAllGroups(true)->shouldReturn('response');
    }
}
