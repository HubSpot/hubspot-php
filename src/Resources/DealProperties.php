<?php

namespace SevenShores\Hubspot\Resources;

class DealProperties extends Resource
{

    /**
     * Get a Deal Property.
     *
     * Returns a JSON object representing the definition for a given deal property.
     *
     * @see http://developers.hubspot.com/docs/methods/deals/get_deal_property
     *
     * @param string $name The name of the property.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function get($name)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/properties/named/{$name}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Update a deal property.
     *
     * Update a specified deal property.
     *
     * @see http://developers.hubspot.com/docs/methods/deals/update_deal_property
     *
     * @param string $name
     * @param array  $property
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($name, $property)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/properties/named/{$name}";

        $property['name'] = $name;
        $options['json'] = $property;

        return $this->client->request('put', $endpoint, $options);
    }

}
