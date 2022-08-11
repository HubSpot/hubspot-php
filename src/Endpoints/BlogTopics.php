<?php

namespace SevenShores\Hubspot\Endpoints;

class BlogTopics extends Endpoint
{
    /**
     * Get all the blog topcis.
     *
     * @param array $params Optional parameters ['name','slug','limit','offset']
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/list-blog-topics
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/topics';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Search a topic by the query. $query will match name and slug partially.
     *
     * @param string $query  Search query
     * @param array  $params Array of optional parameters ['name','slug','limit', 'offset', 'active', 'blog']
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/search-blog-topics
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function search($query, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/topics/search';

        $params['q'] = $query;

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get a blog topic by ID.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/get-blog-topic-by-id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/topics/{$id}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Create a new blog topic.
     *
     * @param array $prorerties Blog topic's fields
     * @param array $params     Optional parametrs
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/create-blog-topic
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $prorerties, $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/topics';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => $prorerties],
            build_query_string($params)
        );
    }

    /**
     * Update a blog topic.
     *
     * @param int   $id         the blog topic id
     * @param array $prorerties the blog topic fields to update
     * @param array $params     Optional parametrs
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/update-topic
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, array $prorerties = [], array $params = [])
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/topics/{$id}";

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => $prorerties],
            build_query_string($params)
        );
    }

    /**
     * Delete a blog topic.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/delete-blog-topic
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/topics/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Group blog topics.
     *
     * @param array  $topicIds         Array of topic ids
     * @param string $groupedTopicName New name of the group
     * @param array  $params           Optional parametrs
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/group-blog-topics
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function merge(array $topicIds, $groupedTopicName, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/topics/group-topics';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => [
                'topicIds' => $topicIds,
                'groupedTopicName' => $groupedTopicName,
            ],
            ]
        );
    }
}
