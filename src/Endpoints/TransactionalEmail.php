<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/email/transactional_email
 */
class TransactionalEmail extends Endpoint
{
    /**
     * List SMTP API Tokens.
     *
     * @see https://developers.hubspot.com/docs/methods/email/transactional_email/smtpapi_overview/list
     */
    public function getTokens()
    {
        $endpoint = 'https://api.hubapi.com/email/public/v1/smtpapi/tokens';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Send an email designed and maintained in the HubSpot marketing Email Tool.
     *
     * @see https://developers.hubspot.com/docs/methods/email/transactional_email/single-send-overview
     *
     * @param int   $id
     * @param array $message
     * @param array $contactProperties
     * @param array $customProperties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function send($id, $message = [], $contactProperties = [], $customProperties = [])
    {
        $endpoint = 'https://api.hubapi.com/email/public/v1/singleEmail/send';

        $options['json'] = [
            'emailId' => $id,
            'message' => $message,
            'contactProperties' => $contactProperties,
            'customProperties' => $customProperties,
        ];

        return $this->client->request('post', $endpoint, $options);
    }
}
