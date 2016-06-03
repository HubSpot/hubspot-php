<?php

namespace SevenShores\Hubspot\Resources;

class ContactLists extends Resource
{
    /**
     * Create a new contact list.
     *
     * @param array $list Contact list properties.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($list)
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists';

        $options['json'] = $list;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update a contact list.
     *
     * @param int   $id   The contact list id.
     * @param array $list The contact list properties to update.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($id, $list)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}";

        $options['json'] = $list;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Delete a contact list.
     *
     * @param int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($id)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get a set of contact lists.
     *
     * @param array $params ['count', 'offset']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all($params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($id)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param array $ids
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getBatchByIds($ids)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/batch";

        $queryString = build_query_string(['listId' => $ids]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $params Optional parameters ['count', 'offset']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getAllStatic($params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/static";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $params Optional parameters ['count', 'offset']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getAllDynamic($params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/dynamic";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get contacts in a list.
     *
     * @param int   $id     List id
     * @param array $params Optional parameters
     *                      { count, vidOffset, property, propertyMode, formSubmissionMode, showListMemberships }
     * @return \SevenShores\Hubspot\Http\Response
     */
    function contacts($id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}/contacts/all";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get recently added contact from a list.
     *
     * @param int   $id List id
     * @param array $params
     * @return \SevenShores\Hubspot\Http\Response
     */
    function recentContacts($id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}/contacts/recent";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Refresh a list.
     *
     * @param int $id List id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function refresh($id)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}/refresh";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Add a contact to a list.
     *
     * @param int   $list_id
     * @param array $contact_ids
     * @return \SevenShores\Hubspot\Http\Response
     */
    function addContact($list_id, $contact_ids)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$list_id}/add";

        $options['json'] = ['vids' => $contact_ids];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Remove a contact from a list.
     *
     * @param int   $list_id
     * @param array $contact_ids
     * @return \SevenShores\Hubspot\Http\Response
     */
    function removeContact($list_id, $contact_ids)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$list_id}/remove";

        $options['json'] = ['vids' => $contact_ids];

        return $this->client->request('post', $endpoint, $options);
    }

}
