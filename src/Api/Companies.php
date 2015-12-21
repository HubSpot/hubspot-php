<?php

namespace Fungku\HubSpot\Api;

class Companies extends Api
{

    /**
     * Create a company
     * @param array $properties Array of company properties.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/create_company
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($properties)
    {
        $endpoint = '/companies/v2/companies/';
        $options['json'] = ['properties' => $properties];

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Updates a company
     * @param int $id The company id.
     * @param array $properties The company properties to update.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/update_company
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($id, $properties)
    {
        $endpoint = "/companies/v2/companies/{$id}";
        $options['json'] = ['properties' => $properties];

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Deletes a company
     * @param int $id The company id
     *
     * @link http://developers.hubspot.com/docs/methods/companies/delete_company
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "/companies/v2/companies/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Returns the recently modified companies
     * @param array $params Array of optional parameters ['count', 'offset']
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_companies_modified
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getRecentlyModified($params = [])
    {
        $endpoint = '/companies/v2/companies/recent/modified';

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Returns the recently created companies
     * @param array $params Array of optional parameters ['count', 'offset']
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_companies_created
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getRecentlyCreated($params = [])
    {
        $endpoint = '/companies/v2/companies/recent/created';

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Returns an array of companies that have a matching domain
     * @param string $domain The domain of the company eq. 'example.com'.
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_companies_by_domain
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getByDomain($domain)
    {
        $endpoint = "/companies/v2/companies/domain/{$domain}";

        return $this->request('get', $endpoint);
    }

    /**
     * Returns a company with id $id
     * @param int $id
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_company
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "/companies/v2/companies/{$id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Associates a given contact to a given company
     * If a contact is already associated to a different company, the contact will be added to the new company
     * @param int $contactId
     * @param int $companyId
     *
     * @link http://developers.hubspot.com/docs/methods/companies/add_contact_to_company
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function addContact($contactId, $companyId)
    {
        $endpoint = "/companies/v2/companies/{$companyId}/contacts/{$contactId}";

        return $this->request('put', $endpoint);
    }

    /**
     * Returns an array of the associated contacts for the given company
     * @param int $companyId The id of the company.
     * @param array $params Array of optional parameters ['count', 'vidOffset']
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_company_contacts
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getAssociatedContacts($companyId, $params = [])
    {
        $endpoint = "/companies/v2/companies/{$companyId}/contacts";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Returns all of the contact IDs who are associated with the given company
     * @param int $companyId The id of the company.
     * @param array $params Array of optional parameters ['count', 'vidOffset']
     *
     * @link http://developers.hubspot.com/docs/methods/companies/get_company_contacts_by_id
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getAssociatedContactIds($companyId, $params = [])
    {
        $endpoint = "/companies/v2/companies/{$companyId}/vids";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Removes a contact from a company
     * @param int $contactId
     * @param int $companyId
     *
     * @link http://developers.hubspot.com/docs/methods/companies/remove_contact_from_company
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function removeContact($contactId, $companyId)
    {
        $endpoint = "/companies/v2/companies/{$companyId}/contacts/{$contactId}";

        return $this->request('delete', $endpoint);
    }



}
