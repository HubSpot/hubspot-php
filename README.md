# HubSpot PHP API client

[![Latest Stable Version](https://poser.pugx.org/fungku/hubspot/v/stable.svg)](https://packagist.org/packages/fungku/hubspot) [![Total Downloads](https://poser.pugx.org/fungku/hubspot/downloads.svg)](https://packagist.org/packages/fungku/hubspot) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fungku/hubspot/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fungku/hubspot/?branch=master) [![License](https://poser.pugx.org/fungku/hubspot/license.svg)](https://packagist.org/packages/fungku/hubspot)

## Setup

In composer.json:

```
"require": {
	"fungku/hubspot": "1.0.*"
}
```
then run `composer install` or `composer update`


## Example


```php
$hapikey = "demo";

$hubspot = new Fungku\HubSpot($hapikey);

// get 5 contacts' firstnames, offset by 50
$contacts = $hubspot->contacts()->get_all_contacts(array(
    'count' => 5, // defaults to 20
    'property' => 'firstname', // only get the specified properties
    'vidOffset' => '50' // contact offset used for paging
));
```

*Note:* The Hubspot class checks for a `HUBSPOT_APIKEY` environment variable if you don't include one during instantiation.


### haPiHP

#### Overview

A PHP client for HubSpot's APIs.  Docs for this client: [https://github.com/HubSpot/haPiHP/wiki/haPiHP](https://github.com/HubSpot/haPiHP/wiki/haPiHP).

General API reference documentation: [http://developers.hubspot.com/docs](http://developers.hubspot.com/docs).

### Contributors

* [adrianmott](https://github.com/adrianmott) (Adrian Mott)
* [chrishoult](https://github.com/chrishoult) (Christopher Hoult)
* [TheRealBenSmith](https://github.com/TheRealBenSmith) (Ben Smith)
* [ajorgensen](https://github.com/ajorgensen) (Andrew Jorgensen)
* [jprado](https://github.com/jprado)
* [thinkclay](https://github.com/thinkclay) (Clayton McIlrath)
* [adamgoose] (https://github.com/adamgoose) (Adam Engebretson)
