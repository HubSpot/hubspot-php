# HubSpot PHP API client

[![Version](https://img.shields.io/packagist/v/ryanwinchester/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/ryanwinchester/hubspot-php)
 [![Total Downloads](https://img.shields.io/packagist/dt/fungku/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/fungku/hubspot-php)
 [![License](https://img.shields.io/packagist/l/ryanwinchester/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/ryanwinchester/hubspot-php)
 [![CodeClimate Test Coverage](https://img.shields.io/codeclimate/coverage/github/ryanwinchester/hubspot-php.svg?style=flat-square)](https://codeclimate.com/github/ryanwinchester/hubspot-php/coverage)
 [![Build Status](https://img.shields.io/travis/ryanwinchester/hubspot-php.svg?style=flat-square)](https://travis-ci.org/ryanwinchester/hubspot-php)

Hubspot API client. The sequel to my [perfectly functional wrapper](https://github.com/fungku/hubspot) of HubSpot/haPihP.
client. However, this is a complete re-write and includes some of the new COS/v2 endpoints.

## Setup

**Composer:**

```bash
composer require "ryanwinchester/hubspot-php:~1.0"
```

## Quickstart

### Examples Using Factory

All following examples assume this step.

```php
$hubspot = SevenShores\Hubspot\Factory::create('api-key');

// OR instantiate by passing a configuration array.
// The only required value is the 'key'

$hubspot = new SevenShores\Hubspot\Factory([
  'key'      => 'demo',
  'oauth'    => false, // default
  'base_url' => 'https://api.hubapi.com' // default
]);
```
*Note:* You can prevent any error handling provided by this package by passing following options into client creation routine:
(applies also to `Factory::create()` and `Factory::createWithToken()`)

```php
$hubspot = new SevenShores\Hubspot\Factory([
  'key'      => 'demo',
  'oauth'    => false, // default
  'base_url' => 'https://api.hubapi.com' // default
],
[
  'http_errors' = true // pass any Guzzle related option to any request, e.g. throw no exceptions
],
false // return Guzzle Response object for any ->request(*) call
);
```

By setting `http_errors` to true, you will not receive any exceptions at all, but pure responses.
For possible options, see http://docs.guzzlephp.org/en/latest/request-options.html.

#### Get a single contact:

```php
$contact = $hubspot->contacts()->getByEmail("test@hubspot.com");

echo $contact->properties->email->value;
```

#### Paginate through all contacts:

```php
// Get an array of 10 contacts
// getting only the firstname and lastname properties
// and set the offset to 123456
$response = $hubspot->contacts()->all([
    'count'     => 10,
    'property'  => ['firstname', 'lastname'],
    'vidOffset' => 123456,
]);
```

Working with the data is easy!

```php
foreach ($response->contacts as $contact) {
    echo sprintf(
        "Contact name is %s %s." . PHP_EOL,
        $contact->properties->firstname->value,
        $contact->properties->lastname->value
    );
}

// Info for pagination
echo $response->{'has-more'};
echo $response->{'vid-offset'};
```

or if you prefer to use array access?

```php
foreach ($response['contacts'] as $contact) {
    echo sprintf(
        "Contact name is %s %s." . PHP_EOL,
        $contact['properties']['firstname']['value'],
        $contact['properties']['lastname']['value']
    );
}

// Info for pagination
echo $response['has-more'];
echo $response['vid-offset'];
```

Now with response methods implementing [PSR-7 ResponseInterface](https://github.com/php-fig/http-message/tree/master/src)

```php
$response->getStatusCode()   // 200;
$response->getReasonPhrase() // 'OK';
// etc...
```

### Example Without Factory

```php
<?php

require 'vendor/autoload.php';

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Contacts;

$client = new Client(['key' => 'demo']);

$contacts = new Contacts($client);

$response = $contacts->all();

foreach ($response->contacts as $contact) {
    //
}
```

## Status

If you see something not planned, that you want, make an [issue](https://github.com/fungku/hubspot-php/issues) and there's a good chance I will add it.

- [x] Blogs (COS) :new:
- [x] Blog Authors (COS) :new:
- [x] Blog Posts (COS) :new:
- [x] Blog Topics (COS) :new:
- [x] Companies :new:
- [x] Company Properties :new:
- [x] Contacts
- [x] Contact Lists
- [x] Contact Properties
- [x] Deals :new:
- [x] Email :new:
- [x] Email Events :new:
- [x] Engagements
- [x] Events (Enterprise) :new:
- [x] Files (COS) :new:
- [x] Forms
- [x] Keywords
- [x] Owners
- [x] Page Publishing (COS) :new:
- [x] Social Media
- [ ] Templates (COS) :new:
- [x] Timeline :new:
- [x] Workflows
