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
     * @param int   $id      The contact id.
     * @param array $contact The contact properties to update.
     * @return mixed
     */
    public function update($id, array $contact)
    {
        $requestType = 'post';
        $endpoint = "/contacts/v1/contact/vid/{$id}/profile";

        $options['json'] = ['properties' => $contact];

        return $this->call($requestType, $endpoint, $options);
    }

    /**
     * @param string $email   The contact email.
     * @param array  $contact The contact properties.
     * @return mixed
     */
    public function createOrUpdate($email, array $contact)
    {
        $requestType = 'post';
        $endpoint = "/contacts/v1/contact/createOrUpdate/email/{$email}";

        $options['json'] = ['properties' => $contact];

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
