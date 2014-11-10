# HubSpot PHP API client

[![Latest Stable Version](https://poser.pugx.org/fungku/hubspot/v/stable.svg)](https://packagist.org/packages/fungku/hubspot) [![Total Downloads](https://poser.pugx.org/fungku/hubspot/downloads.svg)](https://packagist.org/packages/fungku/hubspot) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fungku/hubspot/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fungku/hubspot/?branch=master) [![License](https://poser.pugx.org/fungku/hubspot/license.svg)](https://packagist.org/packages/fungku/hubspot)

## Setup

In composer.json:

```
"require": {
	"fungku/hubspot-php": "2.0.*"
}
```
then run `composer install` or `composer update`


## Example


```php
$contacts = new Fungku\HubSpot::contacts('your-api-key');

// get 10 contacts' firstnames, offset by 10
$contacts->all([
    'count'     => 10,          // defaults to 20
    'property'  => 'firstname', // only get the specified properties
    'vidOffset' => '10'         // contact offset used for paging
]);
```

*Note:* The Hubspot class checks for a `HUBSPOT_API_KEY` environment variable if you don't include one during instantiation.