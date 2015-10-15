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
     * @return mixed
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
     * @param string $name The name of the property.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_contact_property
     *
     * @return mixed
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
     * @param array $property Property name
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property
     *
     * @return mixed
     */
    public function create(array $property)
    {
        $endpoint = "/contacts/v2/properties";

        $options['json'] = $property;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Update a specified contact property.
     *
     * @param array $property Property key value pair
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/update_contact_property
     *
     * @return mixed
     */
    public function update(array $property)
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
     * @param string $name Property name
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/delete_contact_property
     *
     * @return mixed
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
     * @param bool $includeProperties Include the properties in the response?
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/get_contact_property_groups
     *
     * @return mixed
     */
    public function getGroup($includeProperties = false)
    {
        $endpoint = "/contacts/v2/groups";

        $options['query'] = array('includeProperties' => $includeProperties);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Create a contact property group.
     *
     * Create a new contact property group to gather like contact-level data. Property groups allow you to more
     * easily manage properties in a given portal and make contact records easier to parse for the user.
     *
     * @param array $group Group properties
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property_group
     *
     * @return mixed
     */
    public function createGroup(array $group)
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
     * @param array $group Key value pair
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/update_contact_property_group
     *
     * @return mixed
     */
    public function updateGroup(array $group)
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
     * @param string $name Property group name
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/v2/delete_contact_property_group
     *
     * @return mixed
     */
    public function deleteGroup($name)
    {
        $endpoint = "/contacts/v2/groups/named/{$name}";

        return $this->request('delete', $endpoint);
    }
}
