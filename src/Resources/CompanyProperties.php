<?php

namespace SevenShores\Hubspot\Resources;

class CompanyProperties extends Resource
{
    /**
     * Creates a property on every company object to store a specific piece of data.
     * @param array $property
     *
     * @see http://developers.hubspot.com/docs/methods/companies/create_company_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($property)
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/properties/';

        $options['json'] = $property;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update the specified company-level property. This does not update the value on a specified company, but instead changes the definition of the company property.
     * @param string $propertyName
     * @param array $property
     *
     * @see http://developers.hubspot.com/docs/methods/companies/update_company_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($propertyName, $property)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/properties/named/{$propertyName}";

        $property['name'] = $propertyName;
        $options['json'] = $property;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * For a portal, delete an existing company property.
     * @param string $propertyName The API name of the property that you will be deleting.
     *
     * @see http://developers.hubspot.com/docs/methods/companies/delete_company_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($propertyName)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/properties/named/{$propertyName}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Returns a JSON object representing the definition for a given company property.
     * @param string $propertyName The API name of the property that you wish to see metadata for.
     *
     * @see http://developers.hubspot.com/docs/methods/companies/get_company_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function get($propertyName)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/properties/named/{$propertyName}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Returns all of the company properties, including their definition.
     *
     * @see http://developers.hubspot.com/docs/methods/companies/get_company_properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all()
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/properties/';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new company property group to gather like company-level data.
     * @param array $group Defines the group and any properties within it.
     *
     * @see http://developers.hubspot.com/docs/methods/companies/create_company_property_group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function createGroup($group)
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/groups/';

        $options['json'] = $group;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update a previously created company property group.
     * @param string $groupName The API name of the property group that you will be updating.
     * @param array $group Defines the property group and any properties within it.
     *
     * @see http://developers.hubspot.com/docs/methods/companies/update_company_property_group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function updateGroup($groupName, $group)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/groups/named/{$groupName}";

        $group['name'] = $groupName;
        $options['json'] = $group;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete an existing company property group.
     * @param string $groupName The API name of the property group that you will be deleting.
     *
     * @see http://developers.hubspot.com/docs/methods/companies/delete_company_property_group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function deleteGroup($groupName)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/groups/named/{$groupName}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Returns all of the company property groups for a given portal.
     * @param bool $includeProperties If true returns all of the properties for each company property group.
     *
     * @see http://developers.hubspot.com/docs/methods/companies/get_company_property_groups
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getAllGroups($includeProperties = false)
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/groups/';

        if($includeProperties){
            $queryString = build_query_string(['includeProperties' => 'true']);

            return $this->client->request('get', $endpoint, [], $queryString);
        }

        return $this->client->request('get', $endpoint);
    }
}
