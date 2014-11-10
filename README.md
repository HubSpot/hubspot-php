# HubSpot PHP API client


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