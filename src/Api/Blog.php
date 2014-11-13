<?php namespace Fungku\HubSpot\Api;

class Blog extends Api
{
    /**
     * @param array $params
     * @return mixed
     */
    public function all(array $params = [])
    {
        $endpoint = '/blog/v1/list.json';

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    public function getInfo() {}

    public function getComments() {}

    public function getPosts() {}

    public function getPostComments() {}

    public function getCommentInfo() {}

    public function createPost() {}

    public function updatePost() {}

    public function publishPost() {}

    public function createComment() {}

}
