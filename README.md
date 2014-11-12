# HubSpot PHP API client


## Setup (don't bother it does not actually exist, still in development!)

In composer.json:

```
"require": {
	"fungku/hubspot-php": "2.0.*"
}
```
then run `composer install` or `composer update`


## Example


```php
$hubspot = Fungku\HubSpot\HubSpotService::create('demo');

// Get a single contact
$contact = $hubspot->contacts()->getById(196679);

// Get an array of contacts
$collection = $hubspot->contacts()->all([
        'count' => 10,
        'properties' => 'firstname, lastname',
]);

foreach ($collection['contacts'] as $contact) {
    echo $contact['properties']['firstname']['value'];
}

// For pagination
echo $collection['has-more'];
echo $collection['vid-offset'];
```

*Note:* The Hubspot class checks for a `HUBSPOT_API_KEY` environment variable if you don't include one during instantiation.

I would make the syntax cleaner and use a repositories, but as you can see it would take a lot of work. [Here is a sample](https://github.com/fungku/hubspot-php/wiki/Contact-Var-Dump) `var_dump()` of a contact.
