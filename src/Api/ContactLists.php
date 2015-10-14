<?php

namespace Fungku\HubSpot\Api;

class ContactLists extends Api
{
    /**
     * Create a new contact list.
     *
     * @param array $list Contact list properties.
     *
     * @return mixed
     */
    public function create(array $list)
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
     *
     * @return mixed
     */
    public function update($id, array $list)
    {
        $endpoint = "/contacts/v1/lists/{$id}";

        $options['json'] = $list;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Delete a contact list.
     *
     * @param int $id Contact list ID
     *
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "/contacts/v1/lists/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Get a Contact list by ID
     *
     * @param int $id Contact list ID
     *
     * @return mixed
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
     *
     * @return mixed
     */
    public function all($params)
    {
        $endpoint = "/contacts/v1/lists";

        $options['query'] = $this->getQuery($params);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get a list of Contact lists by ID
     *
     * @param array $ids Array of Contact list IDs
     *
     * @return mixed
     */
    public function getBatchByIds(array $ids)
    {
        $endpoint = "/contacts/v1/lists/batch";

        $queryString = $this->generateBatchQuery('listId', $ids);

        return $this->request('get', $endpoint, null, $queryString);
    }

    /**
     * Get all the static lists
     *
     * @param array $params Optional parameters ['count', 'offset']
     *
     * @return mixed
     */
    public function getAllStatic($params)
    {
        $endpoint = "/contacts/v1/lists/static";

        $options['query'] = $this->getQuery($params);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get all the dynamic lists
     *
     * @param array $params Optional parameters ['count', 'offset']
     *
     * @return mixed
     */
    public function getAllDynamic($params)
    {
        $endpoint = "/contacts/v1/lists/dynamic";

        $options['query'] = $this->getQuery($params);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get contacts in a list.
     *
     * @param int   $id     List id
     * @param array $params Optional parameters
     *     { count, vidOffset, property, propertyMode, formSubmissionMode, showListMemberships }
     *
     * @return mixed
     */
    public function contacts($id, $params)
    {
        $endpoint = "/contacts/v1/lists/{$id}/contacts/all";

        if (isset($params['property']) && is_array($params['property'])) {
            $queryString = $this->generateBatchQuery('property', $params['property']);
            unset($params['property']);
        } else {
            $queryString = null;
        }

        $options['query'] = $this->getQuery($params);

        return $this->request('get', $endpoint, $options, $queryString);
    }

    /**
     * Get recently added contact from a list.
     *
     * @param int   $id     List id
     * @param array $params Array of request params
     *
     * @return mixed
     */
    public function recentContacts($id, $params)
    {
        $endpoint = "/contacts/v1/lists/{$id}/contacts/recent";

        $options['query'] = $this->getQuery($params);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Refresh a list.
     *
     * @param int $id List id
     *
     * @return mixed
     */
    public function refresh($id)
    {
        $endpoint = "/contacts/v1/lists/{$id}/refresh";

        return $this->request('post', $endpoint);
    }

    /**
     * Add a contact to a list.
     *
     * @param int   $list_id     Contact list ID
     * @param array $contact_ids Contact Ids
     *
     * @return mixed
     */
    public function addContact($list_id, array $contact_ids)
    {
        $endpoint = "/contacts/v1/lists/{$list_id}/add";

        $options['json'] = array('vids' => $contact_ids);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Remove a contact from a list.
     *
     * @param int   $list_id     Contact list ID
     * @param array $contact_ids Contact Ids
     *
     * @return mixed
     */
    public function removeContact($list_id, array $contact_ids)
    {
        $endpoint = "/contacts/v1/lists/{$list_id}/remove";

        $options['json'] = array('vids' => $contact_ids);

        return $this->request('post', $endpoint, $options);
    }
}
