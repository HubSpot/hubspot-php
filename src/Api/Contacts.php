<?php namespace Fungku\HubSpot\Api;

use Fungku\HubSpot\Exceptions\HubSpotException;

class Contacts extends Api
{
    /**
     * @param array $contact
     * @return mixed
     */
    public function create(array $contact)
    {
        $requestType = 'post';
        $endpoint = '/contacts/v1/contact';

        $options['json'] = ['properties' => $contact];

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function update(array $params)
    {
        $requestType = 'post';
        $endpoint = '/contacts/v1/contact/vid/' . $params['contact_id'] . '/profile';

        $options['json'] = ['properties' => $params['contact']];

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createOrUpdate(array $params)
    {
        $requestType = 'post';
        $endpoint = '/contacts/v1/contact/createOrUpdate/email/' . $params['email'];

        $options['body'] = ['properties' => json_encode($params['contact'])];

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @param array $params ['count', 'property', 'offset']
     * @return mixed
     */
    public function all(array $params = array())
    {
        $requestType = 'get';
        $endpoint = '/contacts/v1/lists/all/contacts/all';

        $options['body'] = $params;

        return $this->call($requestType, $endpoint, $options);
    }

}
