# Contributing

We love pull requests from everyone. By participating in this project, you
agree to not be a jerk.

## Getting Started

- Fork, then clone the repo:
```
    git clone git@github.com:your-username/hubspot-php.git
```

- Set up your machine:
```
    composer install
```

- Make your change. Add test for your changes. Make the tests pass, e.g.:
```
    vendor/bin/phpunit tests/integration/Endpoints/TimelineTest
```
or you can run tests with docker:
1. Copy .env.template to .env
2. Specify data in .env (for most tests it is enough to specify HUBSPOT_TEST_API_KEY)
3. `docker-compose up --build`


- Push to your fork and [submit a pull request][pr].

[pr]: https://github.com/ryanwinchester/hubspot-php/compare/

At this point you're waiting on us. We like to at least comment on pull requests
within three business days (and, typically, one business day). We may suggest
some changes or improvements or alternatives.

Some things that will increase the chance that your pull request is accepted:

* Write tests.
* Follow PSR-2 [style guide][style].
* Write a [good commit message][commit].

[style]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[commit]: http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html

## Adding a new Endpoint

This is actually pretty easy.

- Create a new Class in `src/Endpoints` that extends `Endpoint`.
- Check existing classes for examples, it is pretty simple.
- Add a method for each endpoint with a name that matches the endpoint url.
- Make **required** parameters separate method arguments and *optional* parameters part of a `$params` array

Examples of a good endpoint method:

```php
/**
 * Create a contact property.
 *
 * Create a property on every contact object to store a specific piece of data. In the example below,
 * we want to store an invoice number on a separate field on deals.
 *
 * @see http://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property
 *
 * @param  array  $property
 * @return \SevenShores\Hubspot\Http\Response
 */
function create($property)
{
    $endpoint = "https://api.hubapi.com/contacts/v2/properties";

    $options['json'] = $property;

    return $this->client->request('post', $endpoint, $options);
}
```

```php
/**
 * For a given portal, return all contacts that have been created in the portal.
 *
 * A paginated list of contacts will be returned to you, with a maximum of 100 contacts per page.
 *
 * Please Note: There are 2 fields here to pay close attention to: the "has-more" field that will let you know
 * whether there are more contacts that you can pull from this portal, and the "vid-offset" field which will let
 * you know where you are in the list of contacts. You can then use the "vid-offset" field in the "vidOffset"
 * parameter described below.
 *
 * @see http://developers.hubspot.com/docs/methods/contacts/get_contacts
 *
 * @param  array  $params  Array of optional parameters ['count', 'property', 'vidOffset']
 * @return \SevenShores\Hubspot\Http\Response
 */
function all($params = [])
{
    $endpoint = "https://api.hubapi.com/contacts/v1/lists/all/contacts/all";

    $queryString = build_query_string($params);

    return $this->client->request('get', $endpoint, [], $queryString);
}
```
