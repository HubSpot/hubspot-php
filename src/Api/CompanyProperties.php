<?php

namespace Fungku\HubSpot\Api;

class CompanyProperties extends Api
{
    /**
     * Creates a property on every company object to store a specific piece of data.
     * @param array $property
     *
     * @link http://developers.hubspot.com/docs/methods/companies/create_company_property
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($property)
    {
        $endpoint = '/companies/v2/properties/';

        $options['json'] = $property;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Update the specified company-level property. This does not update the value on a specified company, but instead changes the definition of the company property.
     * @param string $propertyName
     * @param array $property
     *
     * @link http://developers.hubspot.com/docs/methods/companies/update_company_property
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($propertyName, $property)
    {
        $endpoint = "/companies/v2/properties/named/{$propertyName}";

        $property['name'] = $propertyName;
        $options['json'] = $property;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * For a portal, delete an existing company property.
     * @param string $propertyName The API name of the property that you will be deleting.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/delete_company_property
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($propertyName)
    {
        $endpoint = "/companies/v2/properties/named/{$propertyName}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Returns a JSON object representing the definition for a given company property.
     * @param string $propertyName The API name of the property that you wish to see metadata for.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_company_property
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function get($propertyName)
    {
        $endpoint = "/companies/v2/properties/named/{$propertyName}";

        return $this->request('get', $endpoint);
    }

    /**
     * Returns all of the company properties, including their definition.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_company_properties
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all()
    {
        $endpoint = '/companies/v2/properties/';

        return $this->request('get', $endpoint);
    }

    /**
     * Create a new company property group to gather like company-level data.
     * @param array $group Defines the group and any properties within it.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/create_company_property_group
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function createGroup($group)
    {
        $endpoint = '/companies/v2/groups/';

        $options['json'] = $group;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Update a previously created company property group.
     * @param string $groupName The API name of the property group that you will be updating.
     * @param array $group Defines the property group and any properties within it.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/update_company_property_group
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function updateGroup($groupName, $group)
    {
        $endpoint = "/companies/v2/groups/named/{$groupName}";

        $group['name'] = $groupName;
        $options['json'] = $group;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Delete an existing company property group.
     * @param string $groupName The API name of the property group that you will be deleting.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/delete_company_property_group
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function deleteGroup($groupName)
    {
        $endpoint = "/companies/v2/groups/named/{$groupName}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Returns all of the company property groups for a given portal.
     * @param bool $includeProperties If true returns all of the properties for each company property group.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_company_property_groups
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getAllGroups($includeProperties = false)
    {
        $endpoint = '/companies/v2/groups/';

        if($includeProperties){
            $queryString = $this->buildQueryString(['includeProperties' => 'true']);

            return $this->request('get', $endpoint, [], $queryString);
        }

        return $this->request('get', $endpoint);
    }
}
