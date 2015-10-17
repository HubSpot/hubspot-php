<?php

namespace Fungku\HubSpot\Api;

class ContactProperties extends Api
{
    /**
     * Get all Contact properties.
     *
     * Properties in HubSpot are fields that have been created, in this case for deals in a given portal.
     * This endpoint will return all of the contacts properties, including their definition, for a given portal.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/get_contacts_properties
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all()
    {
        $endpoint = '/contacts/v2/properties';

        return $this->request('get', $endpoint);
    }

    /**
     * Get a Contact Property.
     *
     * Returns a JSON object representing the definition for a given contact property.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_contact_property
     *
     * @param string $name The name of the property.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function get($name)
    {
        $endpoint = "contacts/v2/properties/named/{$name}";

        return $this->request('get', $endpoint);
    }

    /**
     * Create a contact property.
     *
     * Create a property on every contact object to store a specific piece of data. In the example below,
     * we want to store an invoice number on a separate field on deals.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property
     *
     * @param array $property
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($property)
    {
        $endpoint = "/contacts/v2/properties";

        $options['json'] = $property;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Update a contact property.
     *
     * Update a specified contact property.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/update_contact_property
     *
     * @param array $property
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($property)
    {
        $endpoint = "/contacts/v2/properties/named/{$property['name']}";

        $options['json'] = $property;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Delete a contact property.
     *
     * For a portal, delete an existing contact property.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/delete_contact_property
     *
     * @param string $name
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($name)
    {
        $endpoint = "/contacts/v2/properties/named/{$name}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Get contact property group.
     *
     * Returns all of the contact property groups for a given portal.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/get_contact_property_groups
     *
     * @param bool $includeProperties
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getGroup($includeProperties = false)
    {
        $endpoint = "/contacts/v2/groups";

        $queryString = $this->buildQueryString(['includeProperties' => $includeProperties]);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Create a contact property group.
     *
     * Create a new contact property group to gather like contact-level data. Property groups allow you to more
     * easily manage properties in a given portal and make contact records easier to parse for the user.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property_group
     *
     * @param array $group Group properties
     * @return \Fungku\HubSpot\Http\Response
     */
    public function createGroup($group)
    {
        $endpoint = "/contacts/v2/groups";

        $options['json'] = $group;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Update a property group.
     *
     * Update a previously created contact property group.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/update_contact_property_group
     *
     * @param array $group
     * @return \Fungku\HubSpot\Http\Response
     */
    public function updateGroup($group)
    {
        $endpoint = "/contacts/v2/groups/named/{$group['name']}";

        $options['json'] = $group;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Delete a property group.
     *
     * Delete an existing contact property group.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/delete_contact_property_group
     *
     * @param string $name
     * @return \Fungku\HubSpot\Http\Response
     */
    public function deleteGroup($name)
    {
        $endpoint = "/contacts/v2/groups/named/{$name}";

        return $this->request('delete', $endpoint);
    }
}
