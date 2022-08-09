<?php

namespace SevenShores\Hubspot\Endpoints;

use SevenShores\Hubspot\Exceptions\BadRequest;

/**
 * @see https://developers.hubspot.com/docs/methods/crm-associations/crm-associations-overview
 */
class CrmAssociations extends Endpoint
{
    public const CONTACT_TO_COMPANY = 1;
    public const COMPANY_TO_CONTACT = 2;
    public const DEAL_TO_CONTACT = 3;
    public const CONTACT_TO_DEAL = 4;
    public const DEAL_TO_COMPANY = 5;
    public const COMPANY_TO_DEAL = 6;
    public const COMPANY_TO_ENGAGEMENT = 7;
    public const ENGAGEMENT_TO_COMPANY = 8;
    public const CONTACT_TO_ENGAGEMENT = 9;
    public const ENGAGEMENT_TO_CONTACT = 10;
    public const DEAL_TO_ENGAGEMENT = 11;
    public const ENGAGEMENT_TO_DEAL = 12;
    public const PARENT_COMPANY_TO_CHILD_COMPANY = 13;
    public const CHILD_COMPANY_TO_PARENT_COMPANY = 14;
    public const CONTACT_TO_TICKET = 15;
    public const TICKET_TO_CONTACT = 16;
    public const TICKET_TO_ENGAGEMENT = 17;
    public const ENGAGEMENT_TO_TICKET = 18;
    public const DEAL_TO_LINE_ITEM = 19;
    public const LINE_ITEM_TO_DEAL = 20;
    public const COMPANY_TO_TICKET = 25;
    public const TICKET_TO_COMPANY = 26;
    public const DEAL_TO_TICKET = 27;
    public const TICKET_TO_DEAL = 28;
    public const ADVISOR_TO_COMPANY = 33;
    public const COMPANY_TO_ADVISOR = 34;
    public const BOARD_MEMBER_TO_COMPANY = 35;
    public const COMPANY_TO_BOARD_MEMBER = 36;
    public const CONTRACTOR_TO_COMPANY = 37;
    public const COMPANY_TO_CONTRACTOR = 38;
    public const MANAGER_TO_COMPANY = 39;
    public const COMPANY_TO_MANAGER = 40;
    public const BUSINESS_OWNER_TO_COMPANY = 41;
    public const COMPANY_TO_BUSINESS_OWNER = 42;
    public const PARTNER_TO_COMPANY = 43;
    public const COMPANY_TO_PARTNER = 44;
    public const RESELLER_TO_COMPANY = 45;
    public const COMPANY_TO_RESELLER = 46;

    /**
     * Get associations for a CRM object.
     *
     * @param mixed $objectId
     *
     * @throws BadRequest
     *
     * @see https://developers.hubspot.com/docs/methods/crm-associations/get-associations
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function get($objectId, int $definitionId, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/crm-associations/v1/associations/{$objectId}/HUBSPOT_DEFINED/{$definitionId}";

        $query_string = null;
        if ($params) {
            $query_string = build_query_string($params);
        }

        return $this->client->request('get', $endpoint, [], $query_string);
    }

    /**
     * Associate CRM objects.
     *
     * @throws BadRequest
     *
     * @see https://developers.hubspot.com/docs/methods/crm-associations/associate-objects
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function create(array $association)
    {
        $endpoint = 'https://api.hubapi.com/crm-associations/v1/associations';

        return $this->client->request('put', $endpoint, ['json' => $association]);
    }

    /**
     * Create multiple associations between CRM objects.
     *
     * @throws BadRequest
     *
     * @see https://developers.hubspot.com/docs/methods/crm-associations/batch-associate-objects
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function createBatch(array $associations)
    {
        $endpoint = 'https://api.hubapi.com/crm-associations/v1/associations/create-batch';

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => $associations]
        );
    }

    /**
     * Delete an association.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-associations/delete-association
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function delete(array $association)
    {
        $endpoint = 'https://api.hubapi.com/crm-associations/v1/associations/delete';

        return $this->client->request('put', $endpoint, ['json' => $association]);
    }

    /**
     * Delete multiple associations between CRM objects.
     *
     * @see https://developers.hubspot.com/docs/methods/crm-associations/batch-delete-associations
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function deleteBatch(array $associations)
    {
        $endpoint = 'https://api.hubapi.com/crm-associations/v1/associations/delete-batch';

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => $associations]
        );
    }
}
