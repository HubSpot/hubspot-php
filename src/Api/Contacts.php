<?php namespace Fungku\HubSpot\Api;

class Contacts extends Api
{
    /**
     * Get all contacts.
     *
     * @param array $options
     * @return mixed
     */
    public function all(array $options = array())
    {
        return $this->client->get($this->url, $options);
    }
}
