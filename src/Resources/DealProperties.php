<?php

namespace SevenShores\Hubspot\Resources;

class DealProperties extends Resource
{
    /**
     * Get a Deal Property.
     *
     * Returns a JSON object representing the definition for a given deal property.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get_deal_property
     *
     * @param string $name the name of the property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function get($name)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/properties/named/{$name}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a deal property.
     *
     * Create a property on every deal object to store a specific piece of data. In the example below,
     * we want to store an invoice number on a separate field on deals.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/create_deal_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $property)
    {
        $endpoint = 'https://api.hubapi.com/properties/v1/deals/properties/';

        return $this->client->request('post', $endpoint, ['json' => $property]);
    }

    /**
     * Update a deal property.
     *
     * Update a specified deal property.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/update_deal_property
     *
     * @param string $name
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($name, array $property)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/properties/named/{$name}";

        $property['name'] = $name;

        return $this->client->request('put', $endpoint, ['json' => $property]);
    }

    /**
     * Delete a deal property.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/delete_deal_property
     *
     * @param string $name
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function delete($name)
    {
        $endpoint = "https://api.hubapi.com/properties/v1/deals/properties/named/{$name}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Returns all of deal properties.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get_deal_properties
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function all()
    {
        $endpoint = 'https://api.hubapi.com/properties/v1/deals/properties/';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new deal property group to gather like deal-level data.
     *
     * @param array $group defines the group and any properties within it
     *
     * @see https://developers.hubspot.com/docs/methods/deals/create_deal_property_group
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function createGroup(array $group)
    {
        $endpoint = 'https://api.hubapi.com/properties/v1/deals/groups/';

        return $this->client->request('post', $endpoint, ['json' => $group]);
    }

    /**
     * Update a previously created deal property group.
     *
     * @param string $groupName the API name of the property group that you will be updating
     * @param array  $group     defines the property group and any properties within it
     *
     * @see https://developers.hubspot.com/docs/methods/deals/update_deal_property_group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateGroup($groupName, array $group)
    {
        $endpoint = "https://api.hubapi.com/properties/v1/deals/groups/named/{$groupName}";

        $group['name'] = $groupName;

        return $this->client->request('put', $endpoint, ['json' => $group]);
    }

    /**
     * Delete an existing deal property group.
     *
     * @param string $groupName the API name of the property group that you will be deleting
     *
     * @see https://developers.hubspot.com/docs/methods/deals/delete_deal_property_group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteGroup($groupName)
    {
        $endpoint = "https://api.hubapi.com/properties/v1/deals/groups/named/{$groupName}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get a deals property group by name.
     *
     * @param string $groupName         the API name of the property group that you will be returned
     * @param bool   $includeProperties if true returns all of the properties for each deal property group
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get_deal_property_group
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getGroup($groupName, $includeProperties = false)
    {
        $endpoint = "https://api.hubapi.com/properties/v1/deals/groups/named/{$groupName}";

        $queryString = '';
        if ($includeProperties) {
            $queryString = build_query_string(['includeProperties' => 'true']);
        }

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Returns all of the deal property groups for a given portal.
     *
     * @param bool $includeProperties if true returns all of the properties for each deal property group
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get_deal_property_groups
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAllGroups($includeProperties = false)
    {
        $endpoint = 'https://api.hubapi.com/properties/v1/deals/groups';

        $queryString = '';
        if ($includeProperties) {
            $queryString = build_query_string(['includeProperties' => 'true']);
        }

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}
