<?php

namespace SevenShores\Hubspot\Resources;

class ContactLists extends Resource
{
    /**
     * Create a new contact list.
     *
     * @param array $list contact list properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/create_list
     */
    public function create(array $list)
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists';

        $options['json'] = $list;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update a contact list.
     *
     * @param int   $id   the contact list id
     * @param array $list the contact list properties to update
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/update_list
     */
    public function update($id, array $list)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}";

        $options['json'] = $list;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Delete a contact list.
     *
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/delete_list
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get a set of contact lists.
     *
     * @param array $params ['count', 'offset']
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_lists
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_list
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_batch_lists
     */
    public function getBatchByIds(array $ids)
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists/batch';

        $queryString = build_query_string(['listId' => $ids]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $params Optional parameters ['count', 'offset']
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_static_lists
     */
    public function getAllStatic(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists/static';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param array $params Optional parameters ['count', 'offset']
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_dynamic_lists
     */
    public function getAllDynamic($params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists/dynamic';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get contacts in a list.
     *
     * @param int   $id     List id
     * @param array $params Optional parameters
     *                      { count, vidOffset, property, propertyMode, formSubmissionMode, showListMemberships }
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_list_contacts
     */
    public function contacts($id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}/contacts/all";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get recently added contact from a list.
     *
     * @param int   $id     List id
     * @param array $params
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_list_contacts_recent
     */
    public function recentContacts($id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}/contacts/recent";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Add a contact to a list.
     *
     * @param int $list_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/add_contact_to_list
     */
    public function addContact($list_id, array $contact_ids, array $emails = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$list_id}/add";

        $options['json'] = [
            'vids' => $contact_ids,
            'emails' => $emails,
        ];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Remove a contact from a list.
     *
     * @param int $list_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/remove_contact_from_list
     */
    public function removeContact($list_id, array $contact_ids)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$list_id}/remove";

        $options['json'] = ['vids' => $contact_ids];

        return $this->client->request('post', $endpoint, $options);
    }
}
