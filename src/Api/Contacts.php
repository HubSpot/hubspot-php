<?php namespace Fungku\HubSpot\Api;

class Contacts extends Api
{
    //protected $create = [
    //    'method'          => 'post',
    //    'endpoint'        => '/contacts/v1/contact',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $update = [
    //    'method'   => 'post',
    //    'endpoint' => '/contacts/v1/contact/vid/{id}/profile',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $createOrUpdate = [
    //    'method'   => 'post',
    //    'endpoint' => '/contacts/v1/contact/createOrUpdate/email/{email}',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $createOrUpdateBatch = [
    //    'method'   => 'post',
    //    'endpoint' => '/contacts/v1/contact/createOrUpdate/email/{email}',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $delete = [
    //    'method'   => 'post',
    //    'endpoint' => '/contacts/v1/contact/vid/{id}',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $all = [
    //    'method'   => 'post',
    //    'endpoint' => '/contacts/v1/lists/all/contacts/all',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $recent = [
    //    'method'   => 'post',
    //    'endpoint' => '/contacts/v1/lists/recently_updated/contacts/recent',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $getById = [
    //    'method'   => 'post',
    //    'endpoint' => '',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $getBatchByIds = [
    //    'method'   => 'post',
    //    'endpoint' => '',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $getByEmail = [
    //    'method'   => 'post',
    //    'endpoint' => '',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $getBatchByEmails = [
    //    'method'   => 'post',
    //    'endpoint' => '',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $getByToken = [
    //    'method'   => 'post',
    //    'endpoint' => '',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $getBatchByTokens = [
    //    'method'   => 'post',
    //    'endpoint' => '',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $search = [
    //    'method'   => 'post',
    //    'endpoint' => '',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //protected $statistics = [
    //    'method'   => 'post',
    //    'endpoint' => '',
    //    'required_params' => [],
    //    'optional_params' => [],
    //];
    //
    //
    ///**
    // * @param array $contact
    // * @return mixed
    // */
    //public function create(array $contact)
    //{
    //    return $this->call('create', compact('contact'));
    //}
    //

//    /**
//     * @param array $contact
//     * @return mixed
//     */
//    public function create(array $contact)
//    {
//        $endpoint = '/contacts/v1/contact';
//
//        $options['json'] = $contact;
//
//        return $this->request('post', $endpoint, $options);
//    }

    /**
     * @param int   $id      The contact id.
     * @param array $contact The contact properties to update.
     * @return mixed
     */
    public function update($id, array $contact)
    {
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        $options['json'] = $contact;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * @param string $email   The contact email.
     * @param array  $contact The contact properties.
     * @return mixed
     */
    public function createOrUpdate($email, array $contact)
    {
        $endpoint = "/contacts/v1/contact/createOrUpdate/email/{$email}";

        $options['json'] = $contact;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * @param array  $contacts The contacts and properties.
     * @return mixed
     */
    public function createOrUpdateBatch(array $contacts)
    {
        $endpoint = "/contacts/v1/contact/batch";

        $options['json'] = $contacts;

        return $this->request('post', $endpoint, $contacts);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "/contacts/v1/contact/vid/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * @param array $params ['count', 'property', 'offset']
     * @return mixed
     */
    public function all(array $params = [])
    {
        $endpoint = "/contacts/v1/lists/all/contacts/all";

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function recent(array $params = [])
    {
        $endpoint = "/contacts/v1/lists/recently_updated/contacts/recent";

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        return $this->request('get', $endpoint);
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

        return $this->request('get', $endpoint);
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

        return $this->request('get', $endpoint, $options, $queryString);
    }

    /**
     * @param string $utk
     * @return mixed
     */
    public function getByToken($utk)
    {
        $endpoint = "/contacts/v1/contact/utk/{$utk}/profile";

        return $this->request('get', $endpoint);
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

        return $this->request('get', $endpoint, $options, $queryString);
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

        return $this->request('get', $endpoint, $params);
    }

    /**
     * @return mixed
     */
    public function statistics()
    {
        $endpoint = "/contacts/v1/contacts/statistics";

        return $this->request('get', $endpoint);
    }

    /**
     * @param string $varName
     * @param array  $items
     * @return string
     */
    private function generateBatchQuery($varName, array $items)
    {
        $queryString = '';

        foreach ($items as $item) {
            $queryString .= "&{$varName}={$item}";
        }

        return $queryString;
    }
}
