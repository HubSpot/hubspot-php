<?php namespace Fungku\HubSpot\Endpoints;

use Fungku\HubSpot\Contracts\Endpoint as EndpointInterface;

class Contact extends Endpoint implements EndpointInterface
{
    protected static $create = [
        'method'          => 'post',
        'endpoint'        => '/contacts/v1/contact',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $update = [
        'method'   => 'post',
        'endpoint' => '/contacts/v1/contact/vid/{id}/profile',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $createOrUpdate = [
        'method'   => 'post',
        'endpoint' => '/contacts/v1/contact/createOrUpdate/email/{email}',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $createOrUpdateBatch = [
        'method'   => 'post',
        'endpoint' => '/contacts/v1/contact/createOrUpdate/email/{email}',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $delete = [
        'method'   => 'post',
        'endpoint' => '/contacts/v1/contact/vid/{id}',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $all = [
        'method'   => 'post',
        'endpoint' => '/contacts/v1/lists/all/contacts/all',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $recent = [
        'method'   => 'post',
        'endpoint' => '/contacts/v1/lists/recently_updated/contacts/recent',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $getById = [
        'method'   => 'post',
        'endpoint' => '',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $getBatchByIds = [
        'method'   => 'post',
        'endpoint' => '',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $getByEmail = [
        'method'   => 'post',
        'endpoint' => '',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $getBatchByEmails = [
        'method'   => 'post',
        'endpoint' => '',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $getByToken = [
        'method'   => 'post',
        'endpoint' => '',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $getBatchByTokens = [
        'method'   => 'post',
        'endpoint' => '',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $search = [
        'method'   => 'post',
        'endpoint' => '',
        'required_params' => [],
        'optional_params' => [],
    ];

    protected static $statistics = [
        'method'   => 'post',
        'endpoint' => '',
        'required_params' => [],
        'optional_params' => [],
    ];

}