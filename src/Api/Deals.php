<?php
namespace Fungku\HubSpot\Api;

use Fungku\HubSpot\Exceptions\HubSpotException;

class Deals extends Api
{
    /**
     * @param array $deal Array of deal properties.
     * @return mixed
     * @throws HubSpotException
     */
    public function create(array $deal)
    {
        $endpoint = "/deals/v1/deal";

        $options['json'] = $deal;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * @param int $id The deal id.
     * @param array $deal The deal properties to update.
     * @return mixed
     */
    public function update($id, array $deal)
    {
        $endpoint = "/deals/v1/deal/{$id}";

        $options['json'] = $deal;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "/deals/v1/deal/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * @param array $params Optional parameters ['limit', 'offset']
     * @return mixed
     */
    public function getRecentlyModified(array $params = [])
    {
        $endpoint = "/deals/v1/deal/recent/modified";
        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $params Optional parameters ['limit', 'offset']
     * @return mixed
     */
    public function getRecentlyCreated(array $params = [])
    {
        $endpoint = "/deals/v1/deal/recent/created";
        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        $endpoint = "/deals/v1/deal/{$id}";

        return $this->request('get', $endpoint);
    }

    /**
     * @param int $dealId
     * @param int|int[] $companyIds
     * @return mixed
     */
    public function associateWithCompany($dealId, $companyIds)
    {
        $endpoint = "/deals/v1/deal/{$dealId}/associations/COMPANY";

        $queryString = $this->buildQueryString(['id' => (array)$companyIds]);

        return $this->request('put', $endpoint, [], $queryString);
    }

    /**
     * @param int $dealId
     * @param int|int[] $companyIds
     * @return mixed
     */
    public function disassociateFromCompany($dealId, $companyIds)
    {
        $endpoint = "/deals/v1/deal/{$dealId}/associations/COMPANY";

        $queryString = $this->buildQueryString(['id' => (array)$companyIds]);

        return $this->request('delete', $endpoint, [], $queryString);
    }

    /**
     * @param int $dealId
     * @param int|int[] $contactIds
     * @return mixed
     */
    public function associateWithContact($dealId, $contactIds)
    {
        $endpoint = "/deals/v1/deal/{$dealId}/associations/CONTACT";

        $queryString = $this->buildQueryString(['id' => (array)$contactIds]);

        return $this->request('put', $endpoint, [], $queryString);
    }

    /**
     * @param int $dealId
     * @param int|int[] $contactIds
     * @return mixed
     */
    public function disassociateFromContact($dealId, $contactIds)
    {
        $endpoint = "/deals/v1/deal/{$dealId}/associations/CONTACT";

        $queryString = $this->buildQueryString(['id' => (array)$contactIds]);

        return $this->request('delete', $endpoint, [], $queryString);
    }
}
