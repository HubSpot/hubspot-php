<?php

namespace Fungku\HubSpot\Api;

class ContactLists extends Api
{
    /**
     * Create a new contact list.
     *
     * @param array $list Contact list properties.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($list)
    {
        $endpoint = '/contacts/v1/lists';

        $options['json'] = $list;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Update a contact list.
     *
     * @param int   $id   The contact list id.
     * @param array $list The contact list properties to update.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($id, $list)
    {
        $endpoint = "/contacts/v1/lists/{$id}";

        $options['json'] = $list;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Delete a contact list.
     *
     * @param int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "/contacts/v1/lists/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * @param int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "/contacts/v1/lists/{$id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Get a set of contact lists.
     *
     * @param array $params ['count', 'offset']
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all($params = [])
    {
        $endpoint = "/contacts/v1/lists";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $ids
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getBatchByIds($ids)
    {
        $endpoint = "/contacts/v1/lists/batch";

        $queryString = $this->buildQueryString(['listId' => $ids]);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $params Optional parameters ['count', 'offset']
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getAllStatic($params = [])
    {
        $endpoint = "/contacts/v1/lists/static";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $params Optional parameters ['count', 'offset']
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getAllDynamic($params = [])
    {
        $endpoint = "/contacts/v1/lists/dynamic";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get contacts in a list.
     *
     * @param int   $id     List id
     * @param array $params Optional parameters
     *                      { count, vidOffset, property, propertyMode, formSubmissionMode, showListMemberships }
     * @return \Fungku\HubSpot\Http\Response
     */
    public function contacts($id, $params = [])
    {
        $endpoint = "/contacts/v1/lists/{$id}/contacts/all";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get recently added contact from a list.
     *
     * @param int   $id List id
     * @param array $params
     * @return \Fungku\HubSpot\Http\Response
     */
    public function recentContacts($id, $params = [])
    {
        $endpoint = "/contacts/v1/lists/{$id}/contacts/recent";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Refresh a list.
     *
     * @param int $id List id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function refresh($id)
    {
        $endpoint = "/contacts/v1/lists/{$id}/refresh";

        return $this->request('post', $endpoint);
    }

    /**
     * Add a contact to a list.
     *
     * @param int   $list_id
     * @param array $contact_ids
     * @return \Fungku\HubSpot\Http\Response
     */
    public function addContact($list_id, $contact_ids)
    {
        $endpoint = "/contacts/v1/lists/{$list_id}/add";

        $options['json'] = ['vids' => $contact_ids];

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Remove a contact from a list.
     *
     * @param int   $list_id
     * @param array $contact_ids
     * @return \Fungku\HubSpot\Http\Response
     */
    public function removeContact($list_id, $contact_ids)
    {
        $endpoint = "/contacts/v1/lists/{$list_id}/remove";

        $options['json'] = ['vids' => $contact_ids];

        return $this->request('post', $endpoint, $options);
    }

}
