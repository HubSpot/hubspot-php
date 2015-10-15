<?php

namespace Fungku\HubSpot\Api;

class SocialMedia extends Api
{
    /**
     * Get all publishing channels.
     *
     * @return mixed
     */
    public function channels()
    {
        $endpoint = '/broadcast/v1/channels/setting/publish/current';

        return $this->request('get', $endpoint);
    }

    /**
     * Get a broadcast channel.
     *
     * @param string $channel_guid Channel GUID
     *
     * @return mixed
     */
    public function getChannelById($channel_guid)
    {
        $endpoint = "/broadcast/v1/channels/{$channel_guid}";

        return $this->request('get', $endpoint);
    }

    /**
     * Get all broadcast messages.
     *
     * @param array $params Parmaters
     *
     * @return mixed
     */
    public function broadcasts($params)
    {
        $endpoint = "/broadcast/v1/broadcasts";

        $options['json'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get a broadcast.
     *
     * @param string $broadcast_guid Broadcase GUID
     *
     * @return mixed
     */
    public function getBroadcastById($broadcast_guid)
    {
        $endpoint = "/broadcast/v1/broadcasts/{$broadcast_guid}";

        return $this->request('get', $endpoint);
    }

    /**
     * Create a new broadcast message.
     *
     * @param array $broadcast Broadcase parameters
     *
     * @return mixed
     */
    public function createBroadcast(array $broadcast)
    {
        $endpoint = "/broadcast/v1/broadcasts";

        $options['json'] = $broadcast;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Cancel a broadcast message.
     *
     * @param string $broadcast_guid Broadcase GUID
     *
     * @return mixed
     */
    public function cancelBroadcast($broadcast_guid)
    {
        $endpoint = "/broadcast/v1/broadcasts/{$broadcast_guid}";

        return $this->request('delete', $endpoint);
    }
}
