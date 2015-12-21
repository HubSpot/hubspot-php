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
}
