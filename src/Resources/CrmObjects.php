<?php

namespace SevenShores\Hubspot\Resources;

/**
 * @see https://developers.hubspot.com/docs/api/crm/crm-custom-objects
 */
class CrmObjects extends Resource
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
     * Get all portal-specific custom objects.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all()
    {
        $endpoint = "https://api.hubapi.com/crm/v3/schemas";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get object schema.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function get()
    {
        $endpoint = "https://api.hubapi.com/crm/v3/schemas/{$this->objectType}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new object.
     * 
     * @see https://developers.hubspot.com/docs/api/crm/crm-custom-objects
     * 
     * The property must exist under properties for them to be specified as primaryDisplayProperty,
     * requiredProperties, searchableProperties, primaryDisplayProperty, and secondaryDisplayProperties.
     * 
     * @param array the object properties.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $properties)
    {
        $endpoint = "https://api.hubapi.com/crm/v3/schemas";

        return $this->client->request('post', $endpoint, ['json' => $properties]);
    }

    /**
     * Update an object or object instance.
     * 
     * @param array the object schema.
     * @param int the object instance id. (optional)
     *
     * Update object properties. Only requiredProperties, searchableProperties, 
     * primaryDisplayProperty, and secondaryDisplayProperties can be modified after creation.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update(array $properties, string $id="")
    {
        if (!empty($id)) {
            $endpoint = "https://api.hubapi.com/crm/v3/objects/{$this->objectType}/{$id}";
        } else {
            $endpoint = "https://api.hubapi.com/crm/v3/schemas/{$this->objectType}";
        }

        return $this->client->request('patch', $endpoint, ['json' => $properties]);
    }

    /**
     * Delete an object or object instance.
     * 
     * @param int the object instance id. (optional)
     * 
     * You can only delete a custom object after all object instances of that type are deleted.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete(string $id="")
    {
        if (!empty($id)) {
            $endpoint = "https://api.hubapi.com/crm/v3/objects/{$this->objectType}/{$id}";
        } else {
            $endpoint = "https://api.hubapi.com/crm/v3/schemas/{$this->objectType}";
        }
        
        return $this->client->request('delete', $endpoint);
    }

    /**
     * Associate an object.
     * 
     * @param array the object schema.
     * 
     * You can only associate your custom object with standard HubSpot objects (e.g. contact,
     * company, deal, or ticket) or other custom objects.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function associate(array $schema)
    {
        $endpoint = "https://api.hubapi.com/crm/v3/schemas/{$this->objectType}/associations";

        return $this->client->request('post', $endpoint, ['json' => $schema]);
    }

}