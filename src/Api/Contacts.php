<?php namespace Fungku\HubSpot\Api;

class Contacts extends Api
{
    /**
     * @param array $contact
     * @return mixed
     */
    public function create(array $contact)
    {
        $requestType = "post";
        $endpoint = '/contacts/v1/contact';

        $options['json'] = $contact;

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @param int   $id      The contact id.
     * @param array $contact The contact properties to update.
     * @return mixed
     */
    public function update($id, array $contact)
    {
        $requestType = "post";
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        $options['json'] = $contact;

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @param string $email   The contact email.
     * @param array  $contact The contact properties.
     * @return mixed
     */
    public function createOrUpdate($email, array $contact)
    {
        $requestType = "post";
        $endpoint = "/contacts/v1/contact/createOrUpdate/email/{$email}";

        $options['json'] = $contact;

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @param array  $contacts The contacts and properties.
     * @return mixed
     */
    public function createOrUpdateBatch(array $contacts)
    {
        $requestType = "post";
        $endpoint = "/contacts/v1/contact/batch";

        $options['json'] = $contacts;

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        $requestType = "delete";
        $endpoint = "/contacts/v1/contact/vid/{$id}";

        return $this->call($requestType, $endpoint);
    }

    /**
     * @param array $params ['count', 'property', 'offset']
     * @return mixed
     */
    public function all(array $params = [])
    {
        $requestType = "get";
        $endpoint = "/contacts/v1/lists/all/contacts/all";

        $options['query'] = $params;

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function recent(array $params = [])
    {
        $requestType = "get";
        $endpoint = "/contacts/v1/lists/recently_updated/contacts/recent";

        $options['query'] = $params;

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        $requestType = "get";
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        return $this->call($requestType, $endpoint);
    }

//    /**
//     * @param array $ids
//     * @return mixed
//     */
//    public function getBatchByIds(array $ids, array $params = [])
//    {
//        $requestType = "get";
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
//        return $this->call($requestType, $endpoint, $options);
//    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        $requestType = "get";
        $endpoint = "/contacts/v1/contact/email/{$email}/profile";

        return $this->call($requestType, $endpoint);
    }

//    /**
//     * @param array $emails
//     * @return mixed
//     */
//    public function getBatchByEmails(array $emails, array $params = [])
//    {
//        $requestType = "get";
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
//        return $this->call($requestType, $endpoint, $options);
//    }

    /**
     * @param string $utk
     * @return mixed
     */
    public function getByToken($utk)
    {
        $requestType = "get";
        $endpoint = "/contacts/v1/contact/utk/{$utk}/profile";

        return $this->call($requestType, $endpoint);
    }


//    /**
//     * @param array $utks
//     * @return mixed
//     */
//    public function getBatchByTokens(array $utks, array $params = [])
//    {
//        $requestType = "get";
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
//        return $this->call($requestType, $endpoint, $options);
//    }

    /**
     * @param string $query
     * @param array  $params
     * @return mixed
     */
    public function search($query, array $params = [])
    {
        $requestType = "get";
        $endpoint = "/contacts/v1/search/query";

        $params['q'] = $query;

        $options['query'] = $params;

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @return mixed
     */
    public function statistics()
    {
        $requestType = "get";
        $endpoint = "/contacts/v1/contacts/statistics";

        return $this->call($requestType, $endpoint);
    }

}
