<?php

namespace SevenShores\Hubspot\Resources;

class SingleEmail extends Resource
{
    /**
     * Send an email designed and maintained in the HubSpot marketing Email Tool.
     *
     * @param array  $params
     * @return \SevenShores\Hubspot\Http\Response
     */
    function send($id, $message = [], $contactProperties = [], $customProperties = [])
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/singleEmail/send";

        $options['json'] = [
          'emailId'           => $id,
          'message'           => $message,
          'contactProperties' => $contactProperties,
          'customProperties'  => $customProperties
        ];

        return $this->client->request('post', $endpoint, $options);
    }
}
