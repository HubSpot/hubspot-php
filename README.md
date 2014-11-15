# HubSpot PHP API client

[![Latest Stable Version](https://poser.pugx.org/fungku/hubspot-php/v/stable.svg)](https://packagist.org/packages/fungku/hubspot-php) [![Latest Unstable Version](https://poser.pugx.org/fungku/hubspot-php/v/unstable.svg)](https://packagist.org/packages/fungku/hubspot-php) [![Total Downloads](https://poser.pugx.org/fungku/hubspot-php/downloads.svg)](https://packagist.org/packages/fungku/hubspot-php) [![License](https://poser.pugx.org/fungku/hubspot-php/license.svg)](https://packagist.org/packages/fungku/hubspot-php)

I've decided to start from scratch on a HubSpot API client. I already have a
[perfectly functional wrapper](https://github.com/fungku/hubspot) of the [haPihP](https://github.com/HubSpot/haPiHP)
client. However, I need some good old fashioned practice, and this is something I'm familiar with and will be using
in the future.

The only dependency is Guzzle, because who likes to use cURL? However, I also want to make it possible to drop the
dependency and swap it out for a cURL implementation fairly easily.

#### [Please check the status before using!](https://github.com/fungku/hubspot-php#status)

## Setup

**Composer:**

```
"require": {
	"fungku/hubspot-php": "dev-master"
}
```

## Quickstart

#### Instantiate hubspot service

All following examples assume this step.

*Note:* The Hubspot class checks for a `HUBSPOT_API_KEY` environment variable if you don't include one during instantiation.

```php
$hubspot = Fungku\HubSpot\HubSpotService::create('api-key');
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

I would make the syntax cleaner `$contact->firstname`, but as you can see it would probably take a lot of work. [Here is a sample](https://github.com/fungku/hubspot-php/wiki/Contact-Var-Dump) `var_dump()` of a contact. I might visit this after all the other Api classes are working, though.

## Status

(:ballot_box_with_check: Complete, :wavy_dash: In Progress, :white_medium_small_square: Todo, :black_medium_small_square: Not planned)

If you see something not planned, that you want, make an [issues](https://github.com/fungku/hubspot-php/issues) and there's a good chance I will add it.

:ballot_box_with_check: COS Blog :new:

:black_medium_small_square: COS Page Publishing :new:

:ballot_box_with_check: Contacts

:wavy_dash: :white_medium_small_square: Contact Lists

:white_medium_small_square: Contact Properties

:white_medium_small_square: COS Files :new:

:white_medium_small_square: Email :new:

:white_medium_small_square: Forms

:white_medium_small_square: Lead Nurturing

:white_medium_small_square: Leads

:white_medium_small_square: Prospects :new:

:white_medium_small_square: Social Media

:white_medium_small_square: Workflows

:black_medium_small_square: Blog (CMS)

:black_medium_small_square: Companies :new:

:black_medium_small_square: Companies Properties :new:

:black_medium_small_square: Deals :new:

:black_medium_small_square: Email Events :new:

:black_medium_small_square: Keywords

:black_medium_small_square: MarketPlace

:black_medium_small_square: Settings
