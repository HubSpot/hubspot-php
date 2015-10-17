<?php

namespace Fungku\HubSpot\Api;


class Contacts extends Api
{
    /**
     * @param array $properties Array of contact properties.
     * @return mixed
     */
    public function create($properties)
    {
        $endpoint = "/contacts/v1/contact";

        $options['json'] = ['properties' => $properties];

        return $this->request('post', $endpoint, $options);
    }

    /**
     * @param int $id The contact id.
     * @param array $properties The contact properties to update.
     * @return mixed
     */
    public function update($id, $properties)
    {
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        $options['json'] = ['properties' => $properties];

        return $this->request('post', $endpoint, $options);
    }

    /**
     * @param string $email The contact's email address.
     * @param array $properties The contact properties.
     * @return mixed
     */
    public function createOrUpdate($email, $properties = [])
    {
        $endpoint = "/contacts/v1/contact/createOrUpdate/email/{$email}";

        $options['json'] = ['properties' => $properties];

        return $this->request('post', $endpoint, $options);
    }

    /**
     * @param array $contacts The contacts and properties.
     * @return mixed
     */
    public function createOrUpdateBatch($contacts)
    {
        $endpoint = "/contacts/v1/contact/batch";

        $options['json'] = $contacts;

        return $this->request('post', $endpoint, $options);
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
     * For a given portal, return all contacts that have been created in the portal.
     *
     * A paginated list of contacts will be returned to you, with a maximum of 100 contacts per page.
     *
     * Please Note: There are 2 fields here to pay close attention to: the "has-more" field that will let you know
     * whether there are more contacts that you can pull from this portal, and the "vid-offset" field which will let
     * you know where you are in the list of contacts. You can then use the "vid-offset" field in the "vidOffset"
     * parameter described below.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/get_contacts
     *
     * @param array $params Array of optional parameters ['count', 'property', 'vidOffset']
     * @return mixed
     */
    public function all($params = [])
    {
        $endpoint = "/contacts/v1/lists/all/contacts/all";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * For a given portal, return all contacts that have been recently updated or created.
     * A paginated list of contacts will be returned to you, with a maximum of 100 contacts per page, as specified by
     * the "count" parameter. The endpoint only scrolls back in time 30 days.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/get_recently_updated_contacts
     *
     * @param array $params Array of optional parameters ['count', 'timeOffset', 'vidOffset', 'property', 'propertyMode', 'formSubmissionMode', 'showListMemberships']
     * @return mixed
     */
    public function recent($params = [])
    {
        $endpoint = "/contacts/v1/lists/recently_updated/contacts/recent";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
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
     * For a given portal, return information about a group of contacts by their unique ID's. A contact's unique ID's
     * is stored in a field called 'vid' which stands for 'visitor ID'.
     *
     * This method will also return you much of the HubSpot lead "intelligence" for each requested contact record. The
     * endpoint accepts many query parameters that allow for customization based on a variety of integration use cases.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/get_batch_by_vid
     *
     * @param array $vids Array of visitor IDs
     * @param array $params Array of optional parameters ['property', 'propertyMode', 'formSubmissionMode', 'showListMemberships', 'includeDeletes']
     * @return mixed
     */
    public function getBatchByIds($vids, $params = [])
    {
        $endpoint = "/contacts/v1/contact/vids/batch/";

        $params['vid'] = $vids;

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
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
     * For a given portal, return information about a group of contacts by their email addresses.
     *
     * This method will also return you much of the HubSpot lead "intelligence" for each requested contact record. The
     * endpoint accepts many query parameters that allow for customization based on a variety of integration use cases.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/get_batch_by_email
     *
     * @param array $emails Array of email adresses
     * @param array $params Array of optional parameters ['property', 'propertyMode', 'formSubmissionMode', 'showListMemberships', 'includeDeletes']
     * @return mixed
     */
    public function getBatchByEmails($emails, $params = [])
    {
        $endpoint = "/contacts/v1/contact/emails/batch/";

        $params['email'] = $emails;

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
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
     * For a given portal, return information about a group of contacts by their user tokens (hubspotutk).
     *
     * This method will also return you much of the HubSpot lead "intelligence" for each requested contact
     * record. The endpoint accepts many query parameters that allow for customization based on a variety of
     * integration use cases.
     *
     * The endpoint does not allow for CORS, so if you are looking up contacts from their user token on the client,
     * you'll need to spin up a proxy server to interact with the API.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/get_batch_by_utk
     *
     * @param array $utks Array of hubspot user tokens (hubspotutk)
     * @param array $params Array of optional parameters ['property', 'propertyMode', 'formSubmissionMode', 'showListMemberships', 'includeDeletes']
     * @return mixed
     */
    public function getBatchByTokens($utks, $params = [])
    {
        $endpoint = "/contacts/v1/contact/utks/batch/";

        $params['utk'] = $utks;

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * For a given portal, return contacts and some data associated with
     * those contacts by the contact's email address or name.
     *
     * Please note that you should expect this method to only return a small
     * subset of data about the contact. One piece of data that the method will
     * return is the contact ID (vid) that you can then use to look up much
     * more data about that particular contact by its ID.
     *
     * @link http://developers.hubspot.com/docs/methods/contacts/search_contacts
     *
     * @param string $query Search query
     * @param array $params Array of optional parameters ['count', 'offset']
     * @return mixed
     */
    public function search($query, $params = [])
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

}
