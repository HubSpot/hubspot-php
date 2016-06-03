<?php

namespace SevenShores\Hubspot\Resources;

class BlogTopics extends Resource
{

    /**
     * Get all the blog topcis
     *
     * @param  array $params Optional parameters ['name','slug','limit','offset']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all($params = [])
    {

        $endpoint = 'https://api.hubapi.com/blogs/v3/topics';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Search a topic by the query. $query will match name and slug partially
     *
     * @see http://developers.hubspot.com/docs/methods/blog/v3/search-blog-topics
     *
     * @param string $query  Search query
     * @param array $params Array of optional parameters ['name','slug','limit', 'offset', 'active', 'blog']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function search($query, $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/topics/search';

        $params['q'] = $query;

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($id)
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/topics/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new blog topic.
     *
     * @param string $name Name of the topic
     * @param  array $params Optional Parameters.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($name, $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/topics';

        $params['name'] = $name;

        $options['json'] = $params;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update a blog topic.
     *
     * @param  int   $id     The blog topic id.
     * @param  array $params The blog topic fields to update.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/topics/{$id}";

        $options['json'] = $params;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a blog topic.
     *
     * @param  int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($id)
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/topics/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Group blog topics
     *
     * @param array $topicIds Array of topic ids
     * @param string $groupedTopicName New name of the group
     * @return \SevenShores\Hubspot\Http\Response
     */
    function merge($topicIds, $groupedTopicName)
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/topics/group-topics";

        $options['json'] = [
            'topicIds' => $topicIds,
            'groupedTopicName' => $groupedTopicName
        ];

        return $this->client->request('post', $endpoint, $options);
    }
}
