<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/companies/company-properties-overview
 */
class CompanyProperties extends Endpoint
{
    /**
     * Creates a property on every company object to store a specific piece of data.
     *
     * @see https://developers.hubspot.com/docs/methods/companies/create_company_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $property)
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/properties/';

        return $this->client->request('post', $endpoint, ['json' => $property]);
    }

    /**
     * Update the specified company-level property. This does not update the value on a specified company, but instead changes the definition of the company property.
     *
     * @see https://developers.hubspot.com/docs/methods/companies/update_company_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update(string $propertyName, array $property)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/properties/named/{$propertyName}";

        $property['name'] = $propertyName;

        return $this->client->request('put', $endpoint, ['json' => $property]);
    }

    /**
     * For a portal, delete an existing company property.
     *
     * @see https://developers.hubspot.com/docs/methods/companies/delete_company_property
     *
     * @param string $propertyName the API name of the property that you will be deleting
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete(string $propertyName)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/properties/named/{$propertyName}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Returns a JSON object representing the definition for a given company property.
     *
     * @see https://developers.hubspot.com/docs/methods/companies/get_company_property
     *
     * @param string $propertyName the API name of the property that you wish to see metadata for
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function get(string $propertyName)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/properties/named/{$propertyName}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Returns all of the company properties, including their definition.
     *
     * @see https://developers.hubspot.com/docs/methods/companies/get_company_properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all()
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/properties/';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new company property group to gather like company-level data.
     *
     * @param array $group defines the group and any properties within it
     *
     * @see https://developers.hubspot.com/docs/methods/companies/create_company_property_group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function createGroup(array $group)
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/groups/';

        return $this->client->request('post', $endpoint, ['json' => $group]);
    }

    /**
     * Update a previously created company property group.
     *
     * @param string $groupName the API name of the property group that you will be updating
     * @param array  $group     defines the property group and any properties within it
     *
     * @see https://developers.hubspot.com/docs/methods/companies/update_company_property_group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateGroup(string $groupName, array $group)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/groups/named/{$groupName}";

        return $this->client->request('put', $endpoint, ['json' => $group]);
    }

    /**
     * Delete an existing company property group.
     *
     * @see https://developers.hubspot.com/docs/methods/companies/delete_company_property_group
     *
     * @param string $groupName the API name of the property group that you will be deleting
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteGroup(string $groupName)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/groups/named/{$groupName}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Returns all of the company property groups for a given portal.
     *
     * @see https://developers.hubspot.com/docs/methods/companies/get_company_property_groups
     *
     * @param bool $includeProperties if true returns all of the properties for each company property group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAllGroups(bool $includeProperties = false)
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/groups/';

        $queryString = '';

        if ($includeProperties) {
            $queryString = build_query_string(['includeProperties' => 'true']);
        }

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}
