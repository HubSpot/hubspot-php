<?php namespace Fungku\HubSpot\Api;

class ContactLists extends Api
{
    /**
     * @param string  $name      The name of the list.
     * @param int     $portalId  The Hub ID of the portal you're creating the list in.
     * @param bool    $dynamic   Identifies whether the list is dynamic or static.
     * @param array   $filters   A list of filters to define what contacts are included.
     * @param array   $listData  Other list data.
     * @return mixed
     */
    public function create($name, $portalId, $dynamic = false, array $filters = [], array $listData = [])
    {
        $method = "post";
        $endpoint = '/contacts/v1/lists';

        $data = [
            'name'     => $name,
            'portalId' => $portalId,
            'dynamic'  => $dynamic,
            'filters'  => $filters,
        ];

        $data = array_merge($data, $listData);

        $options['json'] = $data;

        return $this->request($method, $endpoint, $options);
    }

    /**
     * @param int   $id      The contact id.
     * @param array $contact The contact properties to update.
     * @return mixed
     */
    public function update($id, array $contact)
    {
        $method = "post";
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        $options['json'] = $contact;

        return $this->request($method, $endpoint, $options);
    }

    /**
     * @param string $email   The contact email.
     * @param array  $contact The contact properties.
     * @return mixed
     */
    public function createOrUpdate($email, array $contact)
    {
        $method = "post";
        $endpoint = "/contacts/v1/contact/createOrUpdate/email/{$email}";

        $options['json'] = $contact;

        return $this->request($method, $endpoint, $options);
    }

    /**
     * @param array  $contacts The contacts and properties.
     * @return mixed
     */
    public function createOrUpdateBatch(array $contacts)
    {
        $method = "post";
        $endpoint = "/contacts/v1/contact/batch";

        $options['json'] = $contacts;

        return $this->request($method, $endpoint, $options);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        $method = "delete";
        $endpoint = "/contacts/v1/contact/vid/{$id}";

        return $this->request($method, $endpoint);
    }

    /**
     * @param array $params ['count', 'property', 'offset']
     * @return mixed
     */
    public function all(array $params = [])
    {
        $method = "get";
        $endpoint = "/contacts/v1/lists/all/contacts/all";

        $options['query'] = $params;

        return $this->request($method, $endpoint, $options);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function recent(array $params = [])
    {
        $method = "get";
        $endpoint = "/contacts/v1/lists/recently_updated/contacts/recent";

        $options['query'] = $params;

        return $this->request($method, $endpoint, $options);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        $method = "get";
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        return $this->request($method, $endpoint);
    }

//    /**
//     * @param array $ids
//     * @return mixed
//     */
//    public function getBatchByIds(array $ids, array $params = [])
//    {
//        $method = "get";
//        $endpoint = "/contacts/v1/contact/vids/batch/";
//
//        $vids = [];
//
//        foreach ($ids as $id) {
//            $vids[] = ['vid' => $id];
//        }
//
//        $options['query'] = $vids;
//
//        return $this->request($method, $endpoint, $options);
//    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        $method = "get";
        $endpoint = "/contacts/v1/contact/email/{$email}/profile";

        return $this->request($method, $endpoint);
    }

//    /**
//     * @param array $emails
//     * @return mixed
//     */
//    public function getBatchByEmails(array $emails, array $params = [])
//    {
//        $method = "get";
//        $endpoint = "/contacts/v1/contact/vids/batch/";
//
//        $em = [];
//
//        foreach ($emails as $email) {
//            $em[] = ['email' => $email];
//        }
//
//        $options['query'] = $em;
//
//        return $this->request($method, $endpoint, $options);
//    }

    /**
     * @param string $utk
     * @return mixed
     */
    public function getByToken($utk)
    {
        $method = "get";
        $endpoint = "/contacts/v1/contact/utk/{$utk}/profile";

        return $this->request($method, $endpoint);
    }


//    /**
//     * @param array $utks
//     * @return mixed
//     */
//    public function getBatchByTokens(array $utks, array $params = [])
//    {
//        $method = "get";
//        $endpoint = "/contacts/v1/contact/utks/batch/";
//
//        $tokens = [];
//
//        foreach ($utks as $utk) {
//            $tokens[] = ['utk' => $utk];
//        }
//
//        $options['query'] = $tokens;
//
//        return $this->request($method, $endpoint, $options);
//    }

    /**
     * @param string $query
     * @param array  $params
     * @return mixed
     */
    public function search($query, array $params = [])
    {
        $method = "get";
        $endpoint = "/contacts/v1/search/query";

        $params['q'] = $query;

        $options['query'] = $params;

        return $this->request($method, $endpoint, $options);
    }

    /**
     * @return mixed
     */
    public function statistics()
    {
        $method = "get";
        $endpoint = "/contacts/v1/contacts/statistics";

        return $this->request($method, $endpoint);
    }
}
