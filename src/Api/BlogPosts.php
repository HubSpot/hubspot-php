<?php namespace Fungku\HubSpot\Api;

class BlogPosts extends Api
{
    /**
     * Create a new blog post.
     *
     * @param array $params Optional Parameters.
     * @return mixed
     */
    public function create(array $params = [])
    {
        $endpoint = '/content/api/v2/blog-posts';

        $options['json'] = $params;

        return $this->request('post', $endpoint, $params);
    }

    /**
     * Get all blog posts.
     *
     * @param array $params Optional parameters.
     * @return mixed
     */
    public function all(array $params = [])
    {
        $endpoint = "/content/api/v2/blog-posts";

        $options['query'] = $params;

        return $this->request('get', $endpoint, $params);
    }

    /**
     * @param int   $id     The blog post id.
     * @param array $params The blog post fields to update.
     * @return mixed
     */
    public function update($id, array $params)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}";

        $options['json'] = $params;

        return $this->request('post', $endpoint, $options);
    }

    public function delete($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * @param string $email   The contact email.
     * @param array  $contact The contact properties.
     * @return mixed
     */
    public function createOrUpdate($email, array $contact)
    {
        $endpoint = "/contacts/v1/contact/createOrUpdate/email/{$email}";

        return $this->request('post', $endpoint, $contact);
    }

    /**
     * @param array  $contacts The contacts and properties.
     * @return mixed
     */
    public function createOrUpdateBatch(array $contacts)
    {
        $endpoint = "/contacts/v1/contact/batch";

        return $this->request('post', $endpoint, $contacts);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "/contacts/v1/contact/vid/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function recent(array $params = [])
    {
        $endpoint = "/contacts/v1/lists/recently_updated/contacts/recent";

        return $this->request($endpoint, $params);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        return $this->request($endpoint);
    }

    /**
     * @param array $vids
     * @param array $params
     * @return mixed
     */
    public function getBatchByIds(array $vids, array $params = [])
    {
        $endpoint = "/contacts/v1/contact/vids/batch/";

        $queryString = $this->generateBatchQuery('vid', $vids);

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options, $queryString);
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        $endpoint = "/contacts/v1/contact/email/{$email}/profile";

        return $this->request('get', $endpoint);
    }

    /**
     * @param array $emails
     * @param array $params
     * @return mixed
     */
    public function getBatchByEmails(array $emails, array $params = [])
    {
        $endpoint = "/contacts/v1/contact/vids/batch/";

        $queryString = $this->generateBatchQuery('email', $emails);

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options, $queryString);
    }

    /**
     * @param string $utk
     * @return mixed
     */
    public function getByToken($utk)
    {
        $endpoint = "/contacts/v1/contact/utk/{$utk}/profile";

        return $this->request('get', $endpoint);
    }


    /**
     * @param array $utks
     * @param array $params
     * @return mixed
     */
    public function getBatchByTokens(array $utks, array $params = [])
    {
        $endpoint = "/contacts/v1/contact/utks/batch/";

        $queryString = $this->generateBatchQuery('utk', $utks);

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options, $queryString);
    }

    /**
     * @param string $query
     * @param array  $params
     * @return mixed
     */
    public function search($query, array $params = [])
    {
        $endpoint = "/contacts/v1/search/query";

        $params['q'] = $query;

        return $this->request('get', $endpoint, $params);
    }

    /**
     * @return mixed
     */
    public function statistics()
    {
        $endpoint = "/contacts/v1/contacts/statistics";

        return $this->request('get', $endpoint);
    }

    /**
     * @param string $varName
     * @param array  $items
     * @return string
     */
    private function generateBatchQuery($varName, array $items)
    {
        $queryString = '';

        foreach ($items as $item) {
            $queryString .= "&{$varName}={$item}";
        }

        return $queryString;
    }
}
