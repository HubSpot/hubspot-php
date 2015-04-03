# HubSpot PHP API client

[![Version](https://img.shields.io/packagist/v/fungku/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/fungku/hubspot-php) 
 [![Total Downloads](https://img.shields.io/packagist/dt/fungku/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/fungku/hubspot-php) 
 [![License](https://img.shields.io/packagist/l/fungku/hubspot-php.svg?style=flat-square)](https://packagist.org/packages/fungku/hubspot-php) 
 [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/fungku/hubspot-php.svg?style=flat-square)](https://scrutinizer-ci.com/g/fungku/hubspot-php/?branch=master) 
 [![Build Status](https://img.shields.io/travis/fungku/hubspot-php.svg?style=flat-square)](https://travis-ci.org/fungku/hubspot-php)

A new HubSpot API client. The sequel to my [perfectly functional wrapper](https://github.com/fungku/hubspot) of HubSpot/haPihP.
client. However, this includes some of the new COS/v2 endpoints.

##### BETA

Please try it out, and let me know if things are working as expected.

##### [DOCS](http://fungku.github.io/hubspot-php/api/namespace-Fungku.HubSpot.Api.html)

## Setup

**Composer:**

```json
"require": {
	"fungku/hubspot-php": "~0.9@dev"
}
```

## Quickstart

#### Instantiate hubspot service

All following examples assume this step.

*Note:* The Hubspot class checks for a `HUBSPOT_API_KEY` environment variable if you don't include one during instantiation.

```php
$hubspot = Fungku\HubSpot\HubSpotService::make('api-key');
```

#### Get a single contact:

```php
$contact = $hubspot->contacts()->getByEmail("test@hubspot.com");
```

#### Paginate through all contacts:

```php
// Get an array of 10 contacts
// getting only the firstname and lastname properties
// and set the offset to 123456
$collection = $hubspot->contacts()->all([
        'count'      => 10,
        'properties' => 'firstname, lastname',
        'vidOffset'  => 123456,
]);

foreach ($collection['contacts'] as $contact) {
    echo $contact['properties']['firstname']['value'];
}

// Info for pagination
echo $collection['has-more'];
echo $collection['vid-offset'];
```

#### Get a group of contacts by Ids

```php
$vids = [196189, 196188, 196187];

// Get batch of contacts, and limit properties to firstname
$contacts = $hubspot->contacts()->getBatchByIds($vids, ['property' => 'firstname']);

foreach ($contacts as $contact) {
    echo $contact['properties']['firstname']['value'];
}
```

## Status

(:ballot_box_with_check: Complete, :wavy_dash: In Progress, :white_medium_small_square: Todo, :black_medium_small_square: Not planned)

If you see something not planned, that you want, make an [issue](https://github.com/fungku/hubspot-php/issues) and there's a good chance I will add it.

:ballot_box_with_check: Blog (COS) :new:

:ballot_box_with_check: Blog Posts (COS) :new:

:ballot_box_with_check: Contacts

:ballot_box_with_check: Contact Lists

:ballot_box_with_check: Contact Properties

:ballot_box_with_check: Email :new:

:ballot_box_with_check: Email Events :new:

:ballot_box_with_check: Files (COS) :new:

:ballot_box_with_check: Forms

:ballot_box_with_check: Keywords

:ballot_box_with_check: Page Publishing (COS) :new:

:ballot_box_with_check: Social Media

:ballot_box_with_check: Workflows

:black_medium_small_square: Blog (CMS)

:black_medium_small_square: Companies :new:

:black_medium_small_square: Companies Properties :new:

:black_medium_small_square: Deals :new:

:black_medium_small_square: MarketPlace

:black_medium_small_square: Settings
