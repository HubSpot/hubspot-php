<?php
namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Exceptions\HubspotException;

class Deals extends Resource
{
    /**
     * @param array $deal Array of deal properties.
     * @return mixed
     * @throws HubSpotException
     */
    function create(array $deal)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal";

        $options['json'] = $deal;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param int $id The deal id.
     * @param array $deal The deal properties to update.
     * @return mixed
     */
    function update($id, array $deal)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$id}";

        $options['json'] = $deal;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param int $id
     * @return mixed
     */
    function delete($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * @param array $params Optional parameters ['limit', 'offset']
     * @return mixed
     */
    function getRecentlyModified(array $params = [])
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/recent/modified";
        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $params Optional parameters ['limit', 'offset']
     * @return mixed
     */
    function getRecentlyCreated(array $params = [])
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/recent/created";
        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int $id
     * @return mixed
     */
    function getById($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param int $dealId
     * @param int|int[] $companyIds
     * @return mixed
     */
    function associateWithCompany($dealId, $companyIds)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$dealId}/associations/COMPANY";

        $queryString = build_query_string(['id' => (array)$companyIds]);

        return $this->client->request('put', $endpoint, [], $queryString);
    }

    /**
     * @param int $dealId
     * @param int|int[] $companyIds
     * @return mixed
     */
    function disassociateFromCompany($dealId, $companyIds)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$dealId}/associations/COMPANY";

        $queryString = build_query_string(['id' => (array)$companyIds]);

        return $this->client->request('delete', $endpoint, [], $queryString);
    }

    /**
     * @param int $dealId
     * @param int|int[] $contactIds
     * @return mixed
     */
    function associateWithContact($dealId, $contactIds)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$dealId}/associations/CONTACT";

        $queryString = build_query_string(['id' => (array)$contactIds]);

        return $this->client->request('put', $endpoint, [], $queryString);
    }
    
    /**
     * @param int $contactId
     * @return mixed
     */
    function associatedWithContact($contactId)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/associated/contact/{$contactId}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param int $dealId
     * @param int|int[] $contactIds
     * @return mixed
     */
    function disassociateFromContact($dealId, $contactIds)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/deal/{$dealId}/associations/CONTACT";

        $queryString = build_query_string(['id' => (array)$contactIds]);

        return $this->client->request('delete', $endpoint, [], $queryString);
    }
}
