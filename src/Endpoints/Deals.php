<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/deals/deals_overview
 */
class Deals extends Endpoint
{
    /**
     * Create a deal.
     *
     * @param array $properties   array of deal properties
     * @param array $associations array of IDs for records that the new deal should be associated with
     *
     * @see https://developers.hubspot.com/docs/methods/deals/create_deal
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $properties, array $associations = [])
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/deal';

        $data = ['properties' => $properties];

        if (!empty($associations)) {
            $data['associations'] = $associations;
        }

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => $data]
        );
    }

    /**
     * Update a Deal.
     *
     * @param int   $id         the deal id
     * @param array $properties the deal properties to update
     *
     * @see https://developers.hubspot.com/docs/methods/deals/update_deal
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, array $properties)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$id}";

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => ['properties' => $properties]]
        );
    }

    /**
     * Update a group of existing deal records by their dealId.
     *
     * @param array $properties the deals and properties
     *
     * @see https://developers.hubspot.com/docs/methods/deals/batch-update-deals
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateBatch(array $properties)
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/batch-async/update';

        return $this->client->request('post', $endpoint, ['json' => $properties]);
    }

    /**
     * Get all deals.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get-all-deals
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
     * @param array $params Optional parameters ['limit', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get_deals_modified
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
     * @param array $params Optional parameters ['limit', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get_deals_created
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getRecentlyCreated(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/deal/recent/created';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Delete a Deal.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/deals/delete_deal
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
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/deals/get_deal
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
     * @param int       $dealId
     * @param int|int[] $companyIds
     *
     * @deprecated
     * @see https://developers.hubspot.com/docs/methods/deals/associate_deal
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
     * @param int       $dealId
     * @param int|int[] $companyIds
     *
     * @deprecated
     * @see https://developers.hubspot.com/docs/methods/deals/delete_association
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
     * @param int       $dealId
     * @param int|int[] $contactIds
     *
     * @deprecated
     * @see https://developers.hubspot.com/docs/methods/deals/associate_deal
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
     * @param int   $contactId
     * @param array $params    Optional parameters ['limit', 'offset']
     *
     * @deprecated
     * @see https://developers.hubspot.com/docs/methods/deals/get-associated-deals
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
     * @param int       $dealId
     * @param int|int[] $contactIds
     *
     * @deprecated
     * @see https://developers.hubspot.com/docs/methods/deals/delete_association
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
     * @param string $objectType
     * @param int    $objectId
     *
     * @deprecated
     * @see https://developers.hubspot.com/docs/methods/deals/get-associated-deals
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getAssociatedDeals($objectType, $objectId, array $params = [])
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
