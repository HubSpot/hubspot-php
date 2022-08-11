<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/companies/companies-overview
 */
class Companies extends Endpoint
{
    /**
     * Create a company.
     *
     * @param array $properties array of company properties
     *
     * @see https://developers.hubspot.com/docs/methods/companies/create_company
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $properties)
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/companies/';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['properties' => $properties]]
        );
    }

    /**
     * Updates a company.
     *
     * @param int   $id         the company id
     * @param array $properties the company properties to update
     *
     * @see https://developers.hubspot.com/docs/methods/companies/update_company
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, array $properties)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/companies/{$id}";

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => ['properties' => $properties]]
        );
    }

    /**
     * @param array $companies the companies and properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateBatch(array $companies)
    {
        $endpoint = 'https://api.hubapi.com/companies/v1/batch-async/update';

        return $this->client->request('post', $endpoint, ['json' => $companies]);
    }

    /**
     * Deletes a company.
     *
     * @param int $id The company id
     *
     * @see https://developers.hubspot.com/docs/methods/companies/delete_company
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/companies/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Returns all companies.
     *
     * @param array $params Array of optional parameters ['limit', 'offset', 'properties']
     *
     * @see https://developers.hubspot.com/docs/methods/companies/get-all-companies
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/companies/paged';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Returns the recently modified companies.
     *
     * @param array $params Array of optional parameters ['count', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/companies/get_companies_modified
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getRecentlyModified(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/companies/recent/modified';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Returns the recently created companies.
     *
     * @param array $params Array of optional parameters ['count', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/companies/get_companies_created
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getRecentlyCreated(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/companies/v2/companies/recent/created';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Search for companies by domain.
     *
     * @see https://developers.hubspot.com/docs/methods/companies/search_companies_by_domain
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function searchByDomain(
        string $domain,
        array $properties = [],
        int $limit = 100,
        int $offset = 0
    ) {
        $endpoint = "https://api.hubapi.com/companies/v2/domains/{$domain}/companies";

        return $this->client->request(
            'post',
            $endpoint,
            [
                'json' => [
                    'limit' => $limit,
                    'offset' => [
                        'isPrimary' => true,
                        'companyId' => $offset,
                    ],
                    'requestOptions' => [
                        'properties' => $properties,
                    ],
                ],
            ]
        );
    }

    /**
     * Returns a company with id $id.
     *
     * @param int   $id
     * @param array $params Array of optional parameters ['includeMergeAudits', 'includePropertyVersions']
     *
     * @see https://developers.hubspot.com/docs/methods/companies/get_company
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/companies/v2/companies/{$id}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Associates a given contact to a given company
     * If a contact is already associated to a different company, the contact will be added to the new company.
     *
     * @param int $contactId
     * @param int $companyId
     *
     * @see https://developers.hubspot.com/docs/methods/companies/add_contact_to_company
     * @see CrmAssociations::create is used to create associations between objects
     * @deprecated
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function addContact($contactId, $companyId)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/companies/{$companyId}/contacts/{$contactId}";

        return $this->client->request('put', $endpoint);
    }

    /**
     * Returns an array of the associated contacts for the given company.
     *
     * @param int   $companyId the id of the company
     * @param array $params    Array of optional parameters ['count', 'vidOffset']
     *
     * @see https://developers.hubspot.com/docs/methods/companies/get_company_contacts
     * @see CrmAssociations::get is used to get associations between objects
     * @deprecated
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAssociatedContacts($companyId, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/companies/v2/companies/{$companyId}/contacts";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Returns all of the contact IDs who are associated with the given company.
     *
     * @param int   $companyId the id of the company
     * @param array $params    Array of optional parameters ['count', 'vidOffset']
     *
     * @see https://developers.hubspot.com/docs/methods/companies/get_company_contacts_by_id
     * @see CrmAssociations::get is used to get associations between objects
     * @deprecated
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAssociatedContactIds($companyId, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/companies/v2/companies/{$companyId}/vids";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Removes a contact from a company.
     *
     * @param int $contactId
     * @param int $companyId
     *
     * @see https://developers.hubspot.com/docs/methods/companies/remove_contact_from_company
     * @see CrmAssociations::delete is used to delete associations between objects
     * @deprecated
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function removeContact($contactId, $companyId)
    {
        $endpoint = "https://api.hubapi.com/companies/v2/companies/{$companyId}/contacts/{$contactId}";

        return $this->client->request('delete', $endpoint);
    }
}
