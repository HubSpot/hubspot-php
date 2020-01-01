<?php

namespace SevenShores\Hubspot\Resources;

class Contacts extends Resource
{
    /**
     * @param array $properties array of contact properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/create_contact
     */
    public function create(array $properties)
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/contact';

        $options['json'] = ['properties' => $properties];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param int   $id         the contact id
     * @param array $properties the contact properties to update
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/update_contact
     */
    public function update($id, array $properties)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/contact/vid/{$id}/profile";

        $options['json'] = ['properties' => $properties];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param string $email      the contact's email address
     * @param array  $properties the contact properties to update
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/update_contact-by-email
     */
    public function updateByEmail(string $email, array $properties)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/contact/email/{$email}/profile";

        $options['json'] = ['properties' => $properties];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param string $email      the contact's email address
     * @param array  $properties the contact properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/create_or_update
     */
    public function createOrUpdate(string $email, array $properties = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/contact/createOrUpdate/email/{$email}";

        $options['json'] = ['properties' => $properties];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param array $contacts the contacts and properties
     * @param array $params   Array of optional parameters ['auditId']
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/batch_create_or_update
     */
    public function createOrUpdateBatch(array $contacts, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/contact/batch';

        $queryString = build_query_string($params);

        $options['json'] = $contacts;

        return $this->client->request('post', $endpoint, $options, $queryString);
    }

    /**
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/delete_contact
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/contact/vid/{$id}";

        return $this->client->request('delete', $endpoint);
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
     * @see http://developers.hubspot.com/docs/methods/contacts/get_contacts
     *
     * @param array $params Array of optional parameters ['count', 'property', 'vidOffset']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists/all/contacts/all';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * For a given portal, return all contacts that have been recently updated or created.
     * A paginated list of contacts will be returned to you, with a maximum of 100 contacts per page, as specified by
     * the "count" parameter. The endpoint only scrolls back in time 30 days.
     *
     * @see http://developers.hubspot.com/docs/methods/contacts/get_recently_updated_contacts
     *
     * @param array $params Array of optional parameters ['count', 'timeOffset', 'vidOffset', 'property',
     *                      'propertyMode', 'formSubmissionMode', 'showListMemberships']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function recent(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists/recently_updated/contacts/recent';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * For a given portal, return all contacts that have been recently created.
     * A paginated list of contacts will be returned to you, with a maximum of 100 contacts per page, as specified by
     * the "count" parameter. The endpoint only scrolls back in time 30 days.
     *
     * @see http://developers.hubspot.com/docs/methods/contacts/get_recently_updated_contacts
     *
     * @param array $params Array of optional parameters ['count', 'timeOffset', 'vidOffset', 'property',
     *                      'propertyMode', 'formSubmissionMode', 'showListMemberships']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function recentNew(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists/all/contacts/recent';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int   $id
     * @param array $params Array of optional parameters ['property', 'propertyMode', 'formSubmissionMode',
     *                      'showListMemberships']
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/get_contact
     */
    public function getById($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/contact/vid/{$id}/profile";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * For a given portal, return information about a group of contacts by their unique ID's. A contact's unique ID's
     * is stored in a field called 'vid' which stands for 'visitor ID'.
     *
     * This method will also return you much of the HubSpot lead "intelligence" for each requested contact record. The
     * endpoint accepts many query parameters that allow for customization based on a variety of integration use cases.
     *
     * @see http://developers.hubspot.com/docs/methods/contacts/get_batch_by_vid
     *
     * @param array $vids   Array of visitor IDs
     * @param array $params Array of optional parameters ['property', 'propertyMode', 'formSubmissionMode',
     *                      'showListMemberships', 'includeDeletes']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getBatchByIds(array $vids, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/contact/vids/batch/';

        $params['vid'] = $vids;

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $params Array of optional parameters ['property', 'propertyMode', 'formSubmissionMode',
     *                      'showListMemberships']
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/get_contact_by_email
     */
    public function getByEmail(string $email, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/contact/email/{$email}/profile";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * For a given portal, return information about a group of contacts by their email addresses.
     *
     * This method will also return you much of the HubSpot lead "intelligence" for each requested contact record. The
     * endpoint accepts many query parameters that allow for customization based on a variety of integration use cases.
     *
     * @see http://developers.hubspot.com/docs/methods/contacts/get_batch_by_email
     *
     * @param array $emails Array of email adresses
     * @param array $params Array of optional parameters ['property', 'propertyMode', 'formSubmissionMode',
     *                      'showListMemberships', 'includeDeletes']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getBatchByEmails(array $emails, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/contact/emails/batch/';

        $params['email'] = $emails;

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $params Array of optional parameters ['property', 'propertyMode', 'formSubmissionMode',
     *                      'showListMemberships']
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/get_contact_by_utk
     */
    public function getByToken(string $utk, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/contact/utk/{$utk}/profile";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
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
     * @see http://developers.hubspot.com/docs/methods/contacts/get_batch_by_utk
     *
     * @param array $utks   Array of hubspot user tokens (hubspotutk)
     * @param array $params Array of optional parameters ['property', 'propertyMode', 'formSubmissionMode',
     *                      'showListMemberships', 'includeDeletes']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getBatchByTokens(array $utks, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/contact/utks/batch/';

        $params['utk'] = $utks;

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
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
     * @see http://developers.hubspot.com/docs/methods/contacts/search_contacts
     *
     * @param string $query  Search query
     * @param array  $params Array of optional parameters ['count', 'offset']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function search(string $query, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/search/query';

        $params['q'] = $query;

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function statistics()
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/contacts/statistics';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Merge two contact records. The contact ID in the URL will be treated as the
     * primary contact, and the contact ID in the request body will be treated as
     * the secondary contact.
     *
     * @param int $id         primary contact id
     * @param int $vidToMerge contact ID of the secondary contact
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/contacts/merge-contacts
     */
    public function merge($id, $vidToMerge)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/contact/merge-vids/{$id}/";

        $options['json'] = ['vidToMerge' => $vidToMerge];

        return $this->client->request('post', $endpoint, $options);
    }
}
