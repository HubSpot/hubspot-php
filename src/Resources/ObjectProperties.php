<?php

namespace SevenShores\Hubspot\Resources;

/**
 * @see https://developers.hubspot.com/docs/methods/crm-properties/crm-properties-overview
 */
class ObjectProperties extends Resource
{
    /**
     * @var string
     */
    protected $objectType;

    public function __construct($client, $objectType)
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
    public function get($name)
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
     * @param string $name
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($name, array $property)
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
     * @param string $name
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($name)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/properties/named/{$name}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get all object property groups.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-properties/get-property-groups
     *
     * @param bool $includeProperties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getGroups($includeProperties = false)
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
     * @param bool  $includeProperties
     * @param mixed $name
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getGroup($name, $includeProperties = false)
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
     * @param string $name
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateGroup($name, array $group)
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
     * @param string $name
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteGroup($name)
    {
        $endpoint = "https://api.hubapi.com/properties/v2/{$this->objectType}/groups/named/{$name}";

        return $this->client->request('delete', $endpoint);
    }
}
