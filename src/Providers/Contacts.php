<?php namespace Fungku\HubSpot\Providers;

class Contacts extends HubSpotProvider
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
