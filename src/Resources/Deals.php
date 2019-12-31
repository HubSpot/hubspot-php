<?php

namespace SevenShores\Hubspot\Resources;

/**
 * @see https://developers.hubspot.com/docs/methods/deals/deals_overview
 */
class Deals extends Resource
{
    /**
     * Create a deal.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/create_deal
     *
     * @param array $deal array of deal properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $deal)
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/deal';

        return $this->client->request('post', $endpoint, ['json' => $deal]);
    }

    /**
     * Update a Deal.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/update_deal
     *
     * @param int   $id   the deal id
     * @param array $deal the deal properties to update
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, array $deal)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$id}";

        return $this->client->request('put', $endpoint, ['json' => $deal]);
    }

    /**
     * Update a group of existing deal records by their dealId.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/batch-update-deals
     *
     * @param array $deals the deals and properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateBatch(array $deals)
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/batch-async/update';

        return $this->client->request('post', $endpoint, ['json' => $deals]);
    }

    /**
     * Get all deals.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get-all-deals
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/deal/paged';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get Recently Modified Deals.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get_deals_modified
     *
     * @param array $params Optional parameters ['limit', 'offset']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getRecentlyModified(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/deal/recent/modified';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get Recently Created Deals.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get_deals_created
     *
     * @param array $params Optional parameters ['limit', 'offset']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getRecentlyCreated(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/deal/recent/created';
        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Delete a Deal.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/delete_deal
     *
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get a Deal.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get_deal
     *
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Associate a deal with a company.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/associate_deal
     *
     * @param int       $dealId
     * @param int|int[] $companyIds
     *
     * @deprecated
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function associateWithCompany($dealId, $companyIds)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$dealId}/associations/COMPANY";

        return $this->client->request(
            'put',
            $endpoint,
            [],
            build_query_string(['id' => (array) $companyIds])
        );
    }

    /**
     * Removes a deal's association with a company.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/delete_association
     *
     * @param int       $dealId
     * @param int|int[] $companyIds
     *
     * @deprecated
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function disassociateFromCompany($dealId, $companyIds)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$dealId}/associations/COMPANY";

        return $this->client->request(
            'delete',
            $endpoint,
            [],
            build_query_string(['id' => (array) $companyIds])
        );
    }

    /**
     * Associate a deal with a contact.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/associate_deal
     *
     * @param int       $dealId
     * @param int|int[] $contactIds
     *
     * @deprecated
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function associateWithContact($dealId, $contactIds)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$dealId}/associations/CONTACT";

        return $this->client->request(
            'put',
            $endpoint,
            [],
            build_query_string(['id' => (array) $contactIds])
        );
    }

    /**
     * Get Associated Deals.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get-associated-deals
     *
     * @param int   $contactId
     * @param array $params    Optional parameters ['limit', 'offset']
     *
     * @deprecated
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function associatedWithContact($contactId, $params = [])
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/associated/contact/{$contactId}/paged";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Removes a deal's association with a contact.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/delete_association
     *
     * @param int       $dealId
     * @param int|int[] $contactIds
     *
     * @deprecated
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function disassociateFromContact($dealId, $contactIds)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$dealId}/associations/CONTACT";

        return $this->client->request(
            'delete',
            $endpoint,
            [],
            build_query_string(['id' => (array) $contactIds])
        );
    }

    /**
     * Get Associated Deals.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get-associated-deals
     *
     * @param string $objectType
     * @param int    $objectId
     * @param array  $params
     *
     * @deprecated
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getAssociatedDeals($objectType, $objectId, $params = [])
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/associated/{$objectType}/{$objectId}/paged";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }
}
