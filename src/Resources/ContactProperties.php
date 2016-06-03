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
     * @see http://developers.hubspot.com/docs/methods/contacts/v2/get_contacts_properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all()
    {
        $endpoint = 'https://api.hubapi.com/contacts/v2/properties';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a Contact Property.
     *
     * Returns a JSON object representing the definition for a given contact property.
     *
     * @see http://developers.hubspot.com/docs/methods/companies/get_contact_property
     *
     * @param string $name The name of the property.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function get($name)
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
     * @see http://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property
     *
     * @param array $property
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($property)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/properties";

        $options['json'] = $property;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update a contact property.
     *
     * Update a specified contact property.
     *
     * @see http://developers.hubspot.com/docs/methods/contacts/v2/update_contact_property
     *
     * @param string $name
     * @param array  $property
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($name, $property)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/properties/named/{$name}";

        $property['name'] = $name;
        $options['json'] = $property;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a contact property.
     *
     * For a portal, delete an existing contact property.
     *
     * @see http://developers.hubspot.com/docs/methods/contacts/v2/delete_contact_property
     *
     * @param string $name
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($name)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/properties/named/{$name}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get contact property groups.
     *
     * Returns all of the contact property groups for a given portal.
     *
     * @see http://developers.hubspot.com/docs/methods/contacts/v2/get_contact_property_groups
     *
     * @param bool $includeProperties
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getGroups($includeProperties = false)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/groups";

        $queryString = build_query_string(['includeProperties' => $includeProperties]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Create a contact property group.
     *
     * Create a new contact property group to gather like contact-level data. Property groups allow you to more
     * easily manage properties in a given portal and make contact records easier to parse for the user.
     *
     * @see http://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property_group
     *
     * @param array $group Group properties
     * @return \SevenShores\Hubspot\Http\Response
     */
    function createGroup($group)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/groups";

        $options['json'] = $group;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update a property group.
     *
     * Update a previously created contact property group.
     *
     * @see http://developers.hubspot.com/docs/methods/contacts/v2/update_contact_property_group
     *
     * @param string $name
     * @param array  $group
     * @return \SevenShores\Hubspot\Http\Response
     */
    function updateGroup($name, $group)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/groups/named/{$name}";

        $group['name'] = $name;
        $options['json'] = $group;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a property group.
     *
     * Delete an existing contact property group.
     *
     * @see http://developers.hubspot.com/docs/methods/contacts/v2/delete_contact_property_group
     *
     * @param string $name
     * @return \SevenShores\Hubspot\Http\Response
     */
    function deleteGroup($name)
    {
        $endpoint = "https://api.hubapi.com/contacts/v2/groups/named/{$name}";

        return $this->client->request('delete', $endpoint);
    }
}
