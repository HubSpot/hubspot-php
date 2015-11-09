<?php

namespace Fungku\HubSpot\Api;

class Companies extends Api
{

    /**
     * Create a company
     * @param array $properties Array of company properties.
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
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "/companies/v2/companies/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Returns the recently modified companies
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getRecentlyModified()
    {
        $endpoint = '/companies/v2/companies/recent/modified';

        return $this->request('get', $endpoint);
    }

    /**
     * Returns the recently created companies
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getRecentlyCreated()
    {
        $endpoint = '/companies/v2/companies/recent/created';

        return $this->request('get', $endpoint);
    }

    /**
     * Returns an array of companies that have a matching domain
     * @param string $domain The domain of the company eq. 'example.com'.
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
     * @return \Fungku\HubSpot\Http\Response
     */
    public function addContact($contactId, $companyId)
    {
        $endpoint = "/companies/v2/companies/{$companyId}/contacts/{$contactId}";

        return $this->request('put', $endpoint);
    }

    /**
     * Returns an array of the associated contacts for the given company
     * @param int $id The id of the company.
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getAssociatedContacts($id)
    {
        $endpoint = "/companies/v2/companies/{$id}/contacts";

        return $this->request('get', $endpoint);
    }

    /**
     * Returns all of the contact IDs who are associated with the given company
     * @param int $id The id of the company.
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getAssociatedContactIds($id)
    {
        $endpoint = "/companies/v2/companies/{$id}/vids";

        return $this->request('get', $endpoint);
    }

    /**
     * Removes a contact from a company
     * @param int $contactId
     * @param int $companyId
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function removeContact($contactId, $companyId)
    {
        $endpoint = "/companies/v2/companies/{$companyId}/contacts/{$contactId}";

        return $this->request('delete', $endpoint);
    }



}
