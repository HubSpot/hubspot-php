<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/crm-properties/crm-properties-overview
 */
class ObjectProperties extends Endpoint
{
    /**
     * @var string
     */
    protected $objectType;

    public function __construct($client, string $objectType)
    {
        parent::__construct($client);

        $this->objectType = $objectType;
    }

    /**
     * Get an Object Property.
     *
     * @param string $name the name of the property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function get(string $name)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/properties/named/{$name}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get all object properties.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-properties/get-properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all()
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/properties";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new object property.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-properties/create-property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $property)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/properties";

        return $this->client->request('post', $endpoint, ['json' => $property]);
    }

    /**
     * Update an object property.
     *
     * Update a specified contact property.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-properties/update-property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update(string $name, array $property)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/properties/named/{$name}";

        $property['name'] = $name;

        return $this->client->request('patch', $endpoint, ['json' => $property]);
    }

    /**
     * Delete an object property.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-properties/delete-property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete(string $name)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/properties/named/{$name}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get all object property groups.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-properties/get-property-groups
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAllGroups(bool $includeProperties = false)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/groups";

        $queryString = '';
        if ($includeProperties) {
            $queryString = build_query_string(['includeProperties' => 'true']);
        }

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get an object property group.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-properties/get-property-groups
     *
     * @param mixed $name
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getGroup(string $name, bool $includeProperties = false)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/groups/named/{$name}";

        $queryString = '';
        if ($includeProperties) {
            $queryString = build_query_string(['includeProperties' => 'true']);
        }

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Create an object property group.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-properties/create-property-group
     *
     * @param array $group Group properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function createGroup(array $group)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/groups";

        return $this->client->request('post', $endpoint, ['json' => $group]);
    }

    /**
     * Update an object property group.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-properties/udpate-property-group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateGroup(string $name, array $group)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/groups/named/{$name}";

        $group['name'] = $name;

        return $this->client->request('put', $endpoint, ['json' => $group]);
    }

    /**
     * Delete a property group.
     *
     * Delete an existing contact property group.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-properties/delete-property-group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteGroup(string $name)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/groups/named/{$name}";

        return $this->client->request('delete', $endpoint);
    }
}
