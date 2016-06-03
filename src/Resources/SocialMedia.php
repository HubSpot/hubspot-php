<?php

namespace SevenShores\Hubspot\Resources;

class SocialMedia extends Resource
{
    /**
     * Get all publishing channels.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function channels()
    {
        $endpoint = 'https://api.hubapi.com/broadcast/v1/channels/setting/publish/current';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a broadcast channel.
     *
     * @param string $channel_guid
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getChannelById($channel_guid)
    {
        $endpoint = "https://api.hubapi.com/broadcast/v1/channels/{$channel_guid}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get all broadcast messages.
     *
     * @param array $params
     * @return \SevenShores\Hubspot\Http\Response
     */
    function broadcasts($params = [])
    {
        $endpoint = "https://api.hubapi.com/broadcast/v1/broadcasts";

        $options['json'] = $params;

        return $this->client->request('get', $endpoint, $options);
    }

    /**
     * Get a broadcast.
     *
     * @param string $broadcast_guid
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getBroadcastById($broadcast_guid)
    {
        $endpoint = "https://api.hubapi.com/broadcast/v1/broadcasts/{$broadcast_guid}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new broadcast message.
     *
     * @param array $broadcast
     * @return \SevenShores\Hubspot\Http\Response
     */
    function createBroadcast($broadcast)
    {
        $endpoint = "https://api.hubapi.com/broadcast/v1/broadcasts";

        $options['json'] = $broadcast;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Cancel a broadcast message.
     *
     * @param string $broadcast_guid
     * @return \SevenShores\Hubspot\Http\Response
     */
    function cancelBroadcast($broadcast_guid)
    {
        $endpoint = "https://api.hubapi.com/broadcast/v1/broadcasts/{$broadcast_guid}";

        return $this->client->request('delete', $endpoint);
    }

}
