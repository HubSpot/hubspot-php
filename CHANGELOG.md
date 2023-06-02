# Change Log

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased](https://github.com/HubSpot/hubspot-php/compare/v5.1.1...HEAD)

## [5.1.1]

### Changed

- Fix `Utils\OAuth2::getAuthUrl()` (don't add empty scopes or optional scopes to OAuth url).

## [5.1.0]

### Changed

- `Factory::createWithOAuth2Token()` and `Factory::createWithToken()` announced deprecated.
- Added new method `Factory::createWithAccessToken()`.
- Locked `psr/http-message` to version `v1.1`.
- Fixed `Analytics::getByCategory()`, `Analytics::getByType()` and `Analytics::getHosted()` methods.
- Added new method `Forms:secureSubmit()`.
- Fixed `Forms::submit()` method.
- Updated `RetryMiddlewareFactory::getRetryFunctionByRange()` and `RetryMiddlewareFactory::getRetryFunction()`.

## [5.0.1]

### Changed

- Refactor: Updated naming from resources to endpoints

## [5.0.0]

### Changed

- All `Resources` was renamed to `Endponts` (e.x. `SevenShores\Hubspot\Endpoints\Contacts`)
- Added to exceptions ('SevenShores\Hubspot\Exceptions{ BadRequest, HubspotException}') previous exception
- Fixed wrapResponse (if wrapResponse=false exeptions won't be wrapped)
- Added docker container for running tests and updated contributing.mb
- Webhooks Util announced deprecated
- Signature Util added (Validation requests from HubSpot)

## [4.0.2]

### Changed

- fix warnings on php v8.1

## [4.0.1]

### Changed

- Fix composer json

## [4.0.0]

### Changed

- Update Guzzle version (^7.3)
- Update Php version (>=7.3)
- Update Php cs fixer (^3.4)
- Update Phpunit (^9.5)
- Update Phpspec (^7.1)

## [3.2.1]

### Changed

- Update type hinting
- Update Readme
- Fix Products (rename parameter for createBatch)

## [3.2.0]

### Changed

- companies->getById($id) => companies->getById($id, array $params = [])
- Remove unneeded defaults for files api

## [3.1.0]

### Added

- contacts->addSecondaryEmail()
- contacts->deleteSecondaryEmail()

## [3.0.1]

### Changed

- Files::upload
- Guzzle version 6 or 7

## [3.0.0]

### Changed

- Comments to BlogComments
- Deal create + update change params 
- BlogPosts::clonePost => BlogPosts::clone
- BlogTopics::create remove name
- contactsProperties getGroups => getAllGroups
- CrmPipelines move object type to __construct
- Up Guzzle version to 7
- Up php version to 7.2

## [2.0.5]

### Changed

- Added ability to remove list contacts by email address
- minor changes

## [2.0.3]

### Added

- Line Items Resource
- Products Resource
- Object Properties Resource

### Changed

- Up php version to 7.0
- Update Ecommerce Bridge to v2
- Update Hub DB to v2
- Update Form(only submit) to v3
- Update Workflows to v3
- Rename Email to EmailSubscriptions
- Update many resources (Method's Visibility, Type Hinting etc)
- Repair majority of tests
- SingleEmail => TransactionEmail

## [1.0.0-rc.1]

### Added

- [CHANGELOG](http://keepachangelog.com/) @ryanwinchester
- Two new Exception classes @ryanwinchester

### Changed

- Namespace renamed from `Fungku\HubSpot` to `SevenShores\Hubspot` @ryanwinchester
- `Api` folder and namespace renamed to `Resources` @ryanwinchester
- The factory `HubSpotService` renamed to `Factory` @ryanwinchester
- The named static constructors in `Factory` were changed to `create()` and `createWithToken()` @ryanwinchester
- The `Factory` constructor was also made public @ryanwinchester
- Moved functionality of `Api` into `Client` and replaced `Api` with `Resource` @ryanwinchester
- `Client` is now constructed with a configuration array @ryanwinchester
- Removed `$base_url` in favour of putting the whole endpoint url in the resource methods. @ryanwinchester
- Optional `HUBSPOT_API_KEY` environment variable changed to `HUBSPOT_SECRET` @ryanwinchester
- Made `$data` property of `Response` public. Because why not? @ryanwinchester

### Fixed

- Trying to return a response with`RequestException` in the `Client`. It now re-throws a new `BadRequest` Exception. [#48](https://github.com/ryanwinchester/hubspot-php/issues/48) @ryanwinchester
