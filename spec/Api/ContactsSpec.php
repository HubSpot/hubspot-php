<?php

namespace spec\Fungku\HubSpot\Api;

use Fungku\HubSpot\Http\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContactsSpec extends ObjectBehavior
{
    private $client;

    private $apiKey = 'demo';

    private $baseUrl = 'https://api.hubapi.com';

    private $headers = [
        'User-Agent' => 'Fungku_HubSpot_PHP/0.9 (https://github.com/fungku/hubspot-php)',
    ];

    private function getUrl($endpoint)
    {
        return $this->baseUrl . $endpoint . '?hapikey=' . $this->apiKey;
    }

    function let(Client $client)
    {
        $this->beConstructedWith('demo', $client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\HubSpot\Api\Contacts');
    }

//    function it_makes_create_request()
//    {
//        $contact = ['email' => 'test@123test.com'];
//
//        $this->client->post(self::getUrl('/contacts/v1/contact'), [
//            'json'    => ['properties' => $contact],
//            'headers' => $this->headers,
//        ])->shouldBeCalled();
//
//        $this->create($contact);
//    }
//
//    function it_makes_an_update_request()
//    {
//        $contact = ['email' => 'test@123test.com'];
//        $id = 1;
//
//        $this->client->post(self::getUrl("/contacts/v1/contact/vid/{$id}/profile"), [
//            'json'    => ['properties' => $contact],
//            'headers' => $this->headers,
//        ])->shouldBeCalled();
//
//        $this->update($id, $contact);
//    }
    //
    ///**
    // * @param array $contact The contact properties.
    // * @return mixed
    // */
    //public function createOrUpdate(array $contact)
    //{
    //    $endpoint = "/contacts/v1/contact/createOrUpdate/email/{$contact['email']}";
    //
    //    $options['json'] = $contact;
    //
    //    return $this->request('post', $endpoint, $options);
    //}
    //
    ///**
    // * @param array $contacts The contacts and properties.
    // * @return mixed
    // */
    //public function createOrUpdateBatch(array $contacts)
    //{
    //    $endpoint = "/contacts/v1/contact/batch";
    //
    //    $options['json'] = $contacts;
    //
    //    return $this->request('post', $endpoint, $contacts);
    //}
    //
    ///**
    // * @param int $id
    // * @return mixed
    // */
    //public function delete($id)
    //{
    //    $endpoint = "/contacts/v1/contact/vid/{$id}";
    //
    //    return $this->request('delete', $endpoint);
    //}
    //
    ///**
    // * @param array $params Optional parameters ['count', 'property', 'offset']
    // * @return mixed
    // */
    //public function all(array $params = [])
    //{
    //    $endpoint = "/contacts/v1/lists/all/contacts/all";
    //
    //    $options['query'] = $params;
    //
    //    return $this->request('get', $endpoint, $options);
    //}
    //
    ///**
    // * @param array $params
    // * @return mixed
    // */
    //public function recent(array $params = [])
    //{
    //    $endpoint = "/contacts/v1/lists/recently_updated/contacts/recent";
    //
    //    $options['query'] = $params;
    //
    //    return $this->request('get', $endpoint, $options);
    //}
    //
    ///**
    // * @param int $id
    // * @return mixed
    // */
    //public function getById($id)
    //{
    //    $endpoint = "/contacts/v1/contact/vid/{$id}/profile";
    //
    //    return $this->request('get', $endpoint);
    //}
    //
    ///**
    // * @param array $vids
    // * @param array $params
    // * @return mixed
    // */
    //public function getBatchByIds(array $vids, array $params = [])
    //{
    //    $endpoint = "/contacts/v1/contact/vids/batch/";
    //
    //    $queryString = $this->generateBatchQuery('vid', $vids);
    //
    //    $options['query'] = $params;
    //
    //    return $this->request('get', $endpoint, $options, $queryString);
    //}
    //
    ///**
    // * @param string $email
    // * @return mixed
    // */
    //public function getByEmail($email)
    //{
    //    $endpoint = "/contacts/v1/contact/email/{$email}/profile";
    //
    //    return $this->request('get', $endpoint);
    //}
    //
    ///**
    // * @param array $emails
    // * @param array $params
    // * @return mixed
    // */
    //public function getBatchByEmails(array $emails, array $params = [])
    //{
    //    $endpoint = "/contacts/v1/contact/vids/batch/";
    //
    //    $queryString = $this->generateBatchQuery('email', $emails);
    //
    //    $options['query'] = $params;
    //
    //    return $this->request('get', $endpoint, $options, $queryString);
    //}
    //
    ///**
    // * @param string $utk
    // * @return mixed
    // */
    //public function getByToken($utk)
    //{
    //    $endpoint = "/contacts/v1/contact/utk/{$utk}/profile";
    //
    //    return $this->request('get', $endpoint);
    //}
    //
    ///**
    // * @param array $utks
    // * @param array $params
    // * @return mixed
    // */
    //public function getBatchByTokens(array $utks, array $params = [])
    //{
    //    $endpoint = "/contacts/v1/contact/utks/batch/";
    //
    //    $queryString = $this->generateBatchQuery('utk', $utks);
    //
    //    $options['query'] = $params;
    //
    //    return $this->request('get', $endpoint, $options, $queryString);
    //}
    //
    ///**
    // * @param string $query
    // * @param array  $params
    // * @return mixed
    // */
    //public function search($query, array $params = [])
    //{
    //    $endpoint = "/contacts/v1/search/query";
    //
    //    $params['q'] = $query;
    //
    //    return $this->request('get', $endpoint, $params);
    //}
    //
    ///**
    // * @return mixed
    // */
    //public function statistics()
    //{
    //    $endpoint = "/contacts/v1/contacts/statistics";
    //
    //    return $this->request('get', $endpoint);
    //}

}
