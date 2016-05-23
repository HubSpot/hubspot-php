# HubSpot PHP API client

[![Version](https://img.shields.io/packagist/v/fungku/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/fungku/hubspot-php)
 [![Total Downloads](https://img.shields.io/packagist/dt/fungku/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/fungku/hubspot-php)
 [![License](https://img.shields.io/packagist/l/fungku/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/fungku/hubspot-php)
 [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/ryanwinchester/hubspot-php.svg?style=flat-square)](https://scrutinizer-ci.com/g/ryanwinchester/hubspot-php/?branch=master)
  [![CodeClimate Test Coverage](https://img.shields.io/codeclimate/coverage/github/ryanwinchester/hubspot-php.svg?style=flat-square)](https://codeclimate.com/github/ryanwinchester/hubspot-php/coverage)
 [![Build Status](https://img.shields.io/travis/ryanwinchester/hubspot-php.svg?style=flat-square)](https://travis-ci.org/ryanwinchester/hubspot-php)

A new HubSpot API client. The sequel to my [perfectly functional wrapper](https://github.com/fungku/hubspot) of HubSpot/haPihP.
client. However, this is a complete re-write and includes some of the new COS/v2 endpoints.

##### BETA

Please try it out, and let me know if things are working as expected. There may still be a few small breaking changes here and there, so it is not recommended to use this in production unless you really know what you're doing and don't mind working with code that is changing...


#### PHP 5.5+ and Guzzle 6

I've upgraded to Guzzle v6 now.

 - **For php 5.3:** see the [php53](https://github.com/ryanwinchester/hubspot-php/tree/php53) branch. You will need to supply your own `HttpClient` implementation.
 - **For php 5.4:** see the [php54-guzzle5](https://github.com/ryanwinchester/hubspot-php/tree/php54-guzzle5) branch.

## Setup

**Composer:**

```bash
composer require "fungku/hubspot-php: dev-master"
```

## Quickstart

#### Instantiate hubspot service

All following examples assume this step.

*Note:* The HubSpot class checks for a `HUBSPOT_API_KEY` environment variable if you don't include one during instantiation.

```php
$hubspot = Fungku\HubSpot\HubSpotService::make('api-key');
```

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

## Status

If you see something not planned, that you want, make an [issue](https://github.com/fungku/hubspot-php/issues) and there's a good chance I will add it.

- [x] Blog (COS) :new:
- [x] Blog Authors (COS) :new:
- [x] Blog Posts (COS) :new:
- [x] Blog Topics (COS) :new:
- [x] Companies :new:
- [x] Company Properties :new:
- [x] Contacts
- [x] Contact Lists
- [x] Contact Properties
- [ ] Deals :new:
- [x] Email :new:
- [x] Email Events :new:
- [x] Events (Enterprise) :new:
- [x] Files (COS) :new:
- [x] Forms
- [x] Keywords
- [x] Page Publishing (COS) :new:
- [x] Social Media
- [ ] Templates (COS) :new:
- [x] Workflows
