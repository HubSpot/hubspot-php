<?php

namespace SevenShores\Hubspot\Resources;

class ContactProperties extends Resource
{
    /**
     * Get all Contact properties.
     *
     * Properties in HubSpot are fields that have been created, in this case for deals in a given portal.
     * This endpoint will return all of the contacts properties, including their definition, for a given portal.
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/v2/get_contacts_properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all()
    {
        $endpoint = 'https://api.hubapi.com/contacts/v2/properties';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a Contact Property.
     *
     * Returns a JSON object representing the definition for a given contact property.
     *
     * @param string $name the name of the property
     *
     * @see https://developers.hubspot.com/docs/methods/companies/get_contact_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function get($name)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/properties/named/{$name}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a contact property.
     *
     * Create a property on every contact object to store a specific piece of data. In the example below,
     * we want to store an invoice number on a separate field on deals.
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $property)
    {
        $endpoint = 'https://api.hubapi.com/contacts/v2/properties';

        return $this->client->request('post', $endpoint, ['json' => $property]);
    }

    /**
     * Update a contact property.
     *
     * Update a specified contact property.
     *
     * @param string $name
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/v2/update_contact_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($name, array $property)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/properties/named/{$name}";

        $property['name'] = $name;

        return $this->client->request('put', $endpoint, ['json' => $property]);
    }

    /**
     * Delete a contact property.
     *
     * For a portal, delete an existing contact property.
     *
     * @param string $name
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/v2/delete_contact_property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($name)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/properties/named/{$name}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get contact property groups.
     *
     * Returns all of the contact property groups for a given portal.
     *
     * @param bool $includeProperties
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/v2/get_contact_property_groups
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getGroups($includeProperties = false)
    {
        $endpoint = 'https://api.hubapi.com/contacts/v2/groups';

        $queryString = '';
        if ($includeProperties) {
            $queryString = build_query_string(['includeProperties' => 'true']);
        }

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get Contact Property Group Details.
     *
     * @param string $groupName         the internal name of the property group
     * @param bool   $includeProperties if true returns all of the properties for each deal property group
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/v2/get_contact_property_groups
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getGroup(string $groupName, $includeProperties = false)
    {
        $endpoint = "https://api.hubapi.com/properties/v1/contacts/groups/named/{$groupName}";

        $queryString = '';
        if ($includeProperties) {
            $queryString = build_query_string(['includeProperties' => 'true']);
        }

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Create a contact property group.
     *
     * Create a new contact property group to gather like contact-level data. Property groups allow you to more
     * easily manage properties in a given portal and make contact records easier to parse for the user.
     *
     * @param array $group Group properties
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property_group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function createGroup(array $group)
    {
        $endpoint = 'https://api.hubapi.com/contacts/v2/groups';

        return $this->client->request('post', $endpoint, ['json' => $group]);
    }

    /**
     * Update a property group.
     *
     * Update a previously created contact property group.
     *
     * @param string $name
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/v2/update_contact_property_group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateGroup($name, array $group)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/groups/named/{$name}";

        $group['name'] = $name;

        return $this->client->request('put', $endpoint, ['json' => $group]);
    }

    /**
     * Delete a property group.
     *
     * Delete an existing contact property group.
     *
     * @param string $name
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/v2/delete_contact_property_group
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteGroup($name)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/groups/named/{$name}";

        return $this->client->request('delete', $endpoint);
    }
}
