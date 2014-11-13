<?php namespace Fungku\HubSpot\Api;

class Contacts extends Api
{
    /**
     * @param array $contact
     * @return mixed
     */
    public function create(array $contact)
    {
        $endpoint = '/contacts/v1/contact';

        return $this->postRequest($endpoint, $contact);
    }

    /**
     * @param int   $id      The contact id.
     * @param array $contact The contact properties to update.
     * @return mixed
     */
    public function update($id, array $contact)
    {
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        return $this->postRequest($endpoint, $contact);
    }

    /**
     * @param string $email   The contact email.
     * @param array  $contact The contact properties.
     * @return mixed
     */
    public function createOrUpdate($email, array $contact)
    {
        $endpoint = "/contacts/v1/contact/createOrUpdate/email/{$email}";

        return $this->postRequest($endpoint, $contact);
    }

    /**
     * @param array  $contacts The contacts and properties.
     * @return mixed
     */
    public function createOrUpdateBatch(array $contacts)
    {
        $endpoint = "/contacts/v1/contact/batch";

        return $this->postRequest($endpoint, $contacts);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "/contacts/v1/contact/vid/{$id}";

        return $this->deleteRequest($endpoint);
    }

    /**
     * @param array $params ['count', 'property', 'offset']
     * @return mixed
     */
    public function all(array $params = [])
    {
        $endpoint = "/contacts/v1/lists/all/contacts/all";

        return $this->getRequest($endpoint, $params);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function recent(array $params = [])
    {
        $endpoint = "/contacts/v1/lists/recently_updated/contacts/recent";

        return $this->getRequest($endpoint, $params);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        return $this->getRequest($endpoint);
    }

    /**
     * @param array $vids
     * @param array $params
     * @return mixed
     */
    public function getBatchByIds(array $vids, array $params = [])
    {
        $endpoint = "/contacts/v1/contact/vids/batch/";

        $queryString = $this->generateBatchQuery('vid', $vids);

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options, $queryString);
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        $endpoint = "/contacts/v1/contact/email/{$email}/profile";

        return $this->getRequest($endpoint);
    }

    /**
     * @param array $emails
     * @param array $params
     * @return mixed
     */
    public function getBatchByEmails(array $emails, array $params = [])
    {
        $endpoint = "/contacts/v1/contact/vids/batch/";

        $queryString = $this->generateBatchQuery('email', $emails);

        $options['query'] = $params;

        return $this->getRequest($endpoint, $options, $queryString);
    }

    /**
     * @param string $utk
     * @return mixed
     */
    public function getByToken($utk)
    {
        $endpoint = "/contacts/v1/contact/utk/{$utk}/profile";

        return $this->getRequest($endpoint);
    }


    /**
     * @param array $utks
     * @param array $params
     * @return mixed
     */
    public function getBatchByTokens(array $utks, array $params = [])
    {
        $endpoint = "/contacts/v1/contact/utks/batch/";

        $queryString = $this->generateBatchQuery('utk', $utks);

        $options['query'] = $params;

        return $this->getRequest($endpoint, $options, $queryString);
    }

    /**
     * @param string $query
     * @param array  $params
     * @return mixed
     */
    public function search($query, array $params = [])
    {
        $endpoint = "/contacts/v1/search/query";

        $params['q'] = $query;

        return $this->getRequest($endpoint, $params);
    }

    /**
     * @return mixed
     */
    public function statistics()
    {
        $endpoint = "/contacts/v1/contacts/statistics";

        return $this->getRequest($endpoint);
    }

}
