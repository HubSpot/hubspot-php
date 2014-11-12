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

I would make the syntax cleaner and use a repositories, but as you can see it would take a lot of work. Here is a sample `var_dump()` of a contact:

```
array(12) {
  ["vid"]=>
  int(196679)
  ["canonical-vid"]=>
  int(196679)
  ["merged-vids"]=>
  array(0) {
  }
  ["portal-id"]=>
  int(62515)
  ["is-contact"]=>
  bool(true)
  ["profile-token"]=>
  string(140) "AO_T-mPOqEvvCg8kz3Jjg0Rd43-kSJ3b0CGN9pCOu5wzBy2ZAsaEsg2hwajHvhFb_3SdXbTUOjlZo9CODg5tt7iVZrAEopvVuZ2lglLqKZjqdkKBAu-9gCzb4nU0Nu9Bsh-9T4kD1cZg"
  ["profile-url"]=>
  string(202) "https://app.hubspot.com/contacts/62515/lists/public/contact/_AO_T-mPOqEvvCg8kz3Jjg0Rd43-kSJ3b0CGN9pCOu5wzBy2ZAsaEsg2hwajHvhFb_3SdXbTUOjlZo9CODg5tt7iVZrAEopvVuZ2lglLqKZjqdkKBAu-9gCzb4nU0Nu9Bsh-9T4kD1cZg/"
  ["properties"]=>
  array(49) {
    ["phone"]=>
    array(2) {
      ["value"]=>
      string(14) "(678) 462-4105"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(14) "(678) 462-4105"
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_social_linkedin_clicks"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_social_num_broadcast_clicks"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_social_facebook_clicks"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["state"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["salesforceownername"]=>
    array(2) {
      ["value"]=>
      string(10) "Dot Damari"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(10) "Dot Damari"
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          string(10) "continuous"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411053654536)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["createdate"]=>
    array(2) {
      ["value"]=>
      string(13) "1390568790254"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(13) "1390568790254"
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_revenue"]=>
    array(2) {
      ["value"]=>
      string(3) "0.0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(3) "0.0"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["lastname"]=>
    array(2) {
      ["value"]=>
      string(10) "Jean Brown"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(10) "Jean Brown"
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_first_url"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["lastmodifieddate"]=>
    array(2) {
      ["value"]=>
      string(13) "1414183437555"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(13) "1414183437555"
          ["source-type"]=>
          string(10) "CALCULATED"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1414183437555)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["city"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["jobtitle"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_first_referrer"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_num_event_completions"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_source"]=>
    array(2) {
      ["value"]=>
      string(7) "OFFLINE"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(7) "OFFLINE"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_social_google_plus_clicks"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_last_timestamp"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_num_page_views"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["salesforceowneremail"]=>
    array(2) {
      ["value"]=>
      string(15) "damari@live.com"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(15) "damari@live.com"
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          string(10) "continuous"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411053654536)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_first_timestamp"]=>
    array(2) {
      ["value"]=>
      string(13) "1390568790254"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(13) "1390568790254"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["num_conversion_events"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(10) "CALCULATED"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(0)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hubspot_owner_id"]=>
    array(2) {
      ["value"]=>
      string(3) "114"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(3) "114"
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          string(10) "continuous"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411053654536)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_source_data_2"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_source_data_1"]=>
    array(2) {
      ["value"]=>
      string(12) "BATCH_UPDATE"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(12) "BATCH_UPDATE"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["zip"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_num_visits"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_last_referrer"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_last_url"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_social_last_engagement"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["website"]=>
    array(2) {
      ["value"]=>
      string(7) "http://"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(7) "http://"
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["salesforcedeleted"]=>
    array(2) {
      ["value"]=>
      string(4) "true"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(4) "true"
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411259463891)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hubspotscore"]=>
    array(2) {
      ["value"]=>
      string(2) "-5"
      ["versions"]=>
      array(3) {
        [0]=>
        array(6) {
          ["value"]=>
          string(2) "-5"
          ["source-type"]=>
          string(4) "TASK"
          ["source-id"]=>
          string(5) "csrsr"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1414183262699)
          ["selected"]=>
          bool(false)
        }
        [1]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(4) "TASK"
          ["source-id"]=>
          string(5) "csrsr"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1410981401475)
          ["selected"]=>
          bool(false)
        }
        [2]=>
        array(6) {
          ["value"]=>
          string(1) "2"
          ["source-type"]=>
          string(15) "WAL_INCREMENTAL"
          ["source-id"]=>
          string(5) "csrsu"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390570805009)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_social_twitter_clicks"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["firstname"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["num_unique_conversion_events"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(10) "CALCULATED"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(0)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["salesforcelastsynctime"]=>
    array(2) {
      ["value"]=>
      string(13) "1411053654427"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(13) "1411053654427"
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          string(10) "continuous"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411053654536)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_average_page_views"]=>
    array(2) {
      ["value"]=>
      string(1) "0"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(1) "0"
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hubspot_owner_assigneddate"]=>
    array(2) {
      ["value"]=>
      string(13) "1411053654536"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(13) "1411053654536"
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          string(10) "continuous"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411053654536)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["salesforceownerid"]=>
    array(2) {
      ["value"]=>
      string(18) "005i0000000QHLdAAO"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(18) "005i0000000QHLdAAO"
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          string(10) "continuous"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411053654536)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["country"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["message"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["salesforceleadid"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(2) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411259463891)
          ["selected"]=>
          bool(false)
        }
        [1]=>
        array(6) {
          ["value"]=>
          string(18) "00Qi000000X7ItoEAF"
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          string(10) "continuous"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411053654536)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["email"]=>
    array(2) {
      ["value"]=>
      string(21) "inc2938@bellsouth.net"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(21) "inc2938@bellsouth.net"
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["address"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["leadstatus"]=>
    array(2) {
      ["value"]=>
      string(20) "Open - Not Contacted"
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(20) "Open - Not Contacted"
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          string(10) "continuous"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411053654536)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["hs_analytics_first_visit_timestamp"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(9) "ANALYTICS"
          ["source-id"]=>
          string(23) "job_201401031622_339941"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390574454004)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["company"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(12) "BATCH_UPDATE"
          ["source-id"]=>
          NULL
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1390568790015)
          ["selected"]=>
          bool(false)
        }
      }
    }
    ["salesforcecampaignids"]=>
    array(2) {
      ["value"]=>
      string(0) ""
      ["versions"]=>
      array(1) {
        [0]=>
        array(6) {
          ["value"]=>
          string(0) ""
          ["source-type"]=>
          string(10) "SALESFORCE"
          ["source-id"]=>
          string(10) "continuous"
          ["source-label"]=>
          NULL
          ["timestamp"]=>
          int(1411053654536)
          ["selected"]=>
          bool(false)
        }
      }
    }
  }
  ["form-submissions"]=>
  array(0) {
  }
  ["list-memberships"]=>
  array(6) {
    [0]=>
    array(5) {
      ["static-list-id"]=>
      int(286)
      ["internal-list-id"]=>
      int(314)
      ["timestamp"]=>
      int(1390570627337)
      ["vid"]=>
      int(196679)
      ["is-member"]=>
      bool(true)
    }
    [1]=>
    array(5) {
      ["static-list-id"]=>
      int(305)
      ["internal-list-id"]=>
      int(335)
      ["timestamp"]=>
      int(1390570627337)
      ["vid"]=>
      int(196679)
      ["is-member"]=>
      bool(true)
    }
    [2]=>
    array(5) {
      ["static-list-id"]=>
      int(13529)
      ["internal-list-id"]=>
      int(13565)
      ["timestamp"]=>
      int(1393345132707)
      ["vid"]=>
      int(196679)
      ["is-member"]=>
      bool(true)
    }
    [3]=>
    array(5) {
      ["static-list-id"]=>
      int(28538)
      ["internal-list-id"]=>
      int(28580)
      ["timestamp"]=>
      int(1414183441670)
      ["vid"]=>
      int(196679)
      ["is-member"]=>
      bool(true)
    }
    [4]=>
    array(5) {
      ["static-list-id"]=>
      int(40212)
      ["internal-list-id"]=>
      int(40254)
      ["timestamp"]=>
      int(1399791165271)
      ["vid"]=>
      int(196679)
      ["is-member"]=>
      bool(true)
    }
    [5]=>
    array(5) {
      ["static-list-id"]=>
      int(58515)
      ["internal-list-id"]=>
      int(58561)
      ["timestamp"]=>
      int(1405594856296)
      ["vid"]=>
      int(196679)
      ["is-member"]=>
      bool(true)
    }
  }
  ["identity-profiles"]=>
  array(1) {
    [0]=>
    array(2) {
      ["vid"]=>
      int(196679)
      ["identities"]=>
      array(2) {
        [0]=>
        array(3) {
          ["type"]=>
          string(5) "EMAIL"
          ["value"]=>
          string(21) "inc2938@bellsouth.net"
          ["timestamp"]=>
          int(1390568790254)
        }
        [1]=>
        array(3) {
          ["type"]=>
          string(9) "LEAD_GUID"
          ["value"]=>
          string(36) "5ecfce44-09b1-4a89-adbc-c0b064542fc4"
          ["timestamp"]=>
          int(1390569377660)
        }
      }
    }
  }
  ["merge-audits"]=>
  array(0) {
  }
}
```