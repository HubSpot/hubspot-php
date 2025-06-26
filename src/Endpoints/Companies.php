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
}
