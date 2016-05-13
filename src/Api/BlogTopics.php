<?php

namespace Fungku\HubSpot\Api;

class BlogTopics extends Api
{

    /**
     * Get all the blog topcis
     *
     * @param  array $params Optional parameters ['name','slug','limit','offset']
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all($params = [])
    {

        $endpoint = '/blogs/v3/topics';

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Search a topic by the query. $query will match name and slug partially
     *
     * @link http://developers.hubspot.com/docs/methods/blog/v3/search-blog-topics
     *
     * @param string $query  Search query
     * @param array $params Array of optional parameters ['name','slug','limit', 'offset', 'active', 'blog']
     * @return \Fungku\HubSpot\Http\Response
     */
    public function search($query, $params = [])
    {
        $endpoint = '/blogs/v3/topics/search';

        $params['q'] = $query;

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "/blogs/v3/topics/{$id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Create a new blog topic.
     *
     * @param string $name Name of the topic
     * @param  array $params Optional Parameters.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($name, $params = [])
    {
        $endpoint = '/blogs/v3/topics';

        $params['name'] = $name;

        $options['json'] = $params;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Update a blog topic.
     *
     * @param  int   $id     The blog topic id.
     * @param  array $params The blog topic fields to update.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($id, $params = [])
    {
        $endpoint = "/blogs/v3/topics/{$id}";

        $options['json'] = $params;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Delete a blog topic.
     *
     * @param  int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "/blogs/v3/topics/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Group blog topics
     *
     * @param array $topicIds Array of topic ids
     * @param string $groupedTopicName New name of the group
     * @return \Fungku\HubSpot\Http\Response
     */
    public function merge($topicIds, $groupedTopicName)
    {
        $endpoint = "/blogs/v3/topics/group-topics";

        $options['json'] = [
            'topicIds' => $topicIds,
            'groupedTopicName' => $groupedTopicName
        ];

        return $this->request('post', $endpoint, $options);
    }
}
