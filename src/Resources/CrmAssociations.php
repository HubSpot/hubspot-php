<?php

namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Exceptions\BadRequest;

class CrmAssociations extends Resource
{
    const CONTACT_TO_COMPANY = 1;
    const COMPANY_TO_CONTACT = 2;
    const DEAL_TO_CONTACT = 3;
    const CONTACT_TO_DEAL = 4;
    const DEAL_TO_COMPANY = 5;
    const COMPANY_TO_DEAL = 6;
    const COMPANY_TO_ENGAGEMENT = 7;
    const ENGAGEMENT_TO_COMPANY = 8;
    const CONTACT_TO_ENGAGEMENT = 9;
    const ENGAGEMENT_TO_CONTACT = 10;
    const DEAL_TO_ENGAGEMENT = 11;
    const ENGAGEMENT_TO_DEAL = 12;
    const PARENT_COMPANY_TO_CHILD_COMPANY = 13;
    const CHILD_COMPANY_TO_PARENT_COMPANY = 14;
    const CONTACT_TO_TICKET = 15;
    const TICKET_TO_CONTACT = 16;
    const TICKET_TO_ENGAGEMENT = 17;
    const ENGAGEMENT_TO_TICKET = 18;
    const DEAL_TO_LINE_ITEM = 19;
    const LINE_ITEM_TO_DEAL = 20;
    const COMPANY_TO_TICKET = 25;
    const TICKET_TO_COMPANY = 26;
    const DEAL_TO_TICKET = 27;
    const TICKET_TO_DEAL = 28;
    const ADVISOR_TO_COMPANY = 33;
    const COMPANY_TO_ADVISOR = 34;
    const BOARD_MEMBER_TO_COMPANY = 35;
    const COMPANY_TO_BOARD_MEMBER = 36;
    const CONTRACTOR_TO_COMPANY = 37;
    const COMPANY_TO_CONTRACTOR = 38;
    const MANAGER_TO_COMPANY = 39;
    const COMPANY_TO_MANAGER = 40;
    const BUSINESS_OWNER_TO_COMPANY = 41;
    const COMPANY_TO_BUSINESS_OWNER = 42;
    const PARTNER_TO_COMPANY = 43;
    const COMPANY_TO_PARTNER = 44;
    const RESELLER_TO_COMPANY = 45;
    const COMPANY_TO_RESELLER = 46;

    public function get($objectId, $definitionId, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/crm-associations/v1/associations/{$objectId}/HUBSPOT_DEFINED/{$definitionId}";

        if ($params) {
            $endpoint .= '?'.http_build_query($params);
        }

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param array $ticket Array of deal properties.
     *
     * @throws BadRequest
     *
     * @return mixed
     */
    public function create(array $data)
    {
        $endpoint = 'https://api.hubapi.com/crm-associations/v1/associations';

        $options['json'] = $data;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param int   $id     The deal id.
     * @param array $ticket The deal properties to update.
     *
     * @return mixed
     */
    public function delete(array $data)
    {
        $endpoint = 'https://api.hubapi.com/crm-associations/v1/associations/delete';

        $options['json'] = $data;

        return $this->client->request('put', $endpoint, $options);
    }
}
