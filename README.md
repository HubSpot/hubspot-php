# HubSpot PHP API client

[![Version](https://img.shields.io/packagist/v/hubspot/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/hubspot/hubspot-php)
[![Total Downloads](https://img.shields.io/packagist/dt/hubspot/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/hubspot/hubspot-php)
[![Build Status](https://travis-ci.org/hubspot/hubspot-php.svg?branch=master)](https://travis-ci.org/hubspot/hubspot-php)
[![License](https://img.shields.io/packagist/l/hubspot/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/hubspot/hubspot-php)

## Setup

**Composer:**

```bash
composer require "hubspot/hubspot-php"
```

## Quickstart

### Examples Using Factory

All following examples assume this step.

```php
$hubspot = SevenShores\Hubspot\Factory::create('api-key');

// OR create with OAuth2 access token

$hubspot = SevenShores\Hubspot\Factory::createWithOAuth2Token('access-token');

// OR instantiate by passing a configuration array.
// The only required value is the 'key'

$hubspot = new SevenShores\Hubspot\Factory([
  'key'      => 'demo',
  'oauth2'   => 'false', // default
]);
```
*Note:* You can prevent any error handling provided by this package by passing following options into client creation routine:
(applies also to `Factory::create()` and `Factory::createWithOAuth2Token()`)

```php
$hubspot = new SevenShores\Hubspot\Factory([
  'key'      => 'demo',
],
null,
[
  'http_errors' => false // pass any Guzzle related option to any request, e.g. throw no exceptions
],
false // return Guzzle Response object for any ->request(*) call
);
```

By setting `http_errors` to false, you will not receive any exceptions at all, but pure responses.
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

### Example of using built in utils

```php
<?php

require 'vendor/autoload.php';

use SevenShores\Hubspot\Utils\OAuth2;

$authUrl = OAuth2::getAuthUrl(
    'clientId',
    'http://localhost/callaback.php',
    'contacts'
);

```

or using Factory:


```php
<?php

require 'vendor/autoload.php';

use SevenShores\Hubspot\Utils;

$authUrl = Utils::getFactory()->oAuth2()->getAuthUrl(
    'clientId',
    'http://localhost/callaback.php',
    'contacts'
);

```

## Status

If you see something not planned, that you want, make an [issue](https://github.com/fungku/hubspot-php/issues) and there's a good chance I will add it.

- [x] Analytics :new:
- [x] Blogs (COS) :new:
- [x] Blog Authors (COS) :new:
- [x] Blog Posts (COS) :new:
- [x] Blog Topics (COS) :new:
- [x] Companies :new:
- [x] Company Properties :new:
- [x] Contacts
- [x] Contact Lists
- [x] Contact Properties
- [x] CRM Pipelines :new:
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
