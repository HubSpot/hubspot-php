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
     * Create a deal property.
     *
     * Create a property on every deal object to store a specific piece of data. In the example below,
     * we want to store an invoice number on a separate field on deals.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/create_deal_property
     *
     * @param array $property
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($property)
    {
        $endpoint = "https://api.hubapi.com/properties/v1/deals/properties/";

        $options['json'] = $property;

        return $this->client->request('post', $endpoint, $options);
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
