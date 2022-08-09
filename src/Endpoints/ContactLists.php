<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/lists/contact-lists-overview
 */
class ContactLists extends Endpoint
{
    /**
     * Create a new contact list.
     *
     * @param array $properties contact list properties
     *
     * @see https://developers.hubspot.com/docs/methods/lists/create_list
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $properties)
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists';

        return $this->client->request('post', $endpoint, ['json' => $properties]);
    }

    /**
     * Get a set of contact lists.
     *
     * @param array $params ['count', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_lists
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists';

        return $this->client->request('get', $endpoint, [], build_query_string($params));
    }

    /**
     * Get a contact list by its unique ID.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_list
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Update a contact list.
     *
     * @param int   $id         the contact list id
     * @param array $properties the contact list properties to update
     *
     * @see https://developers.hubspot.com/docs/methods/lists/update_list
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, array $properties)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}";

        return $this->client->request('post', $endpoint, ['json' => $properties]);
    }

    /**
     * Delete a contact list.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/lists/delete_list
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get a group of contact lists.
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_batch_lists
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getBatchByIds(array $ids)
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists/batch';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string(['listId' => $ids])
        );
    }

    /**
     * Get static contact lists.
     *
     * @param array $params Optional parameters ['count', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_static_lists
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAllStatic(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists/static';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get dynamic contact lists (active lists).
     *
     * @param array $params Optional parameters ['count', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_dynamic_lists
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAllDynamic(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/contacts/v1/lists/dynamic';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get contacts in a list.
     *
     * @param int   $id     List id
     * @param array $params Optional parameters
     *                      { count, vidOffset, property, propertyMode, formSubmissionMode, showListMemberships }
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_list_contacts
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function contacts($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}/contacts/all";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get recently added contact from a list.
     *
     * @param int $id List id
     *
     * @see https://developers.hubspot.com/docs/methods/lists/get_list_contacts_recent
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function recentContacts($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$id}/contacts/recent";

        return $this->client->request('get', $endpoint, [], build_query_string($params));
    }

    /**
     * Add a contact to a list.
     *
     * @param int $listId
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/lists/add_contact_to_list
     */
    public function addContact($listId, array $contactIds, array $emails = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$listId}/add";

        return $this->client->request(
            'post',
            $endpoint,
            [
                'json' => [
                    'vids' => $contactIds,
                    'emails' => $emails,
                ],
            ]
        );
    }

    /**
     * Remove a contact from a list.
     *
     * @param int $listId
     *
     * @see https://developers.hubspot.com/docs/methods/lists/remove_contact_from_list
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function removeContact($listId, array $contactIds, array $emails = [])
    {
        $endpoint = "https://api.hubapi.com/contacts/v1/lists/{$listId}/remove";

        return $this->client->request(
            'post',
            $endpoint,
            [
                'json' => [
                    'vids' => $contactIds,
                    'emails' => $emails,
                ],
            ]
        );
    }
}
