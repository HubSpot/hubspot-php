<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Forms;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class FormsTest extends EntityTestCase
{
    /**
     * @var null|SevenShores\Hubspot\Endpoints\Forms::class
     */
    protected $endpointClass = Forms::class;

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $response = $this->endpoint->update($this->entity->guid, [
            'name' => 'new name '.uniqid(),
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->endpoint->getById($this->entity->guid);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $reponse = $this->deleteEntity();

        $this->assertEquals(204, $reponse->getStatusCode());

        $this->entity = null;
    }

    /** @test */
    public function getFields()
    {
        $response = $this->endpoint->getFields($this->entity->guid);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getFieldByName()
    {
        $response = $this->endpoint->getFieldByName($this->entity->guid, 'firstname');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function submit()
    {
        $response = $this->endpoint->submit(getenv('HUBSPOT_TEST_PORTAL_ID'), $this->entity->guid, [
            'fields' => [
                [
                    'name' => 'firstname',
                    'value' => 'Test Name',
                ],
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    // Lots of tests need an existing object to modify.
    protected function createEntity()
    {
        return $this->endpoint->create([
            'name' => 'Test Form '.uniqid(),
            'action' => '',
            'method' => 'POST',
            'cssClass' => 'hs-form stacked',
            'redirect' => '',
            'submitText' => 'Sign Up',
            'followUpId' => '',
            'leadNurturingCampaignId' => '',
            'notifyRecipients' => '',
            'embeddedCode' => '',
            'formFieldGroups' => [
                'fields' => [
                    [
                        'name' => 'firstname',
                        'label' => 'First Name',
                        'description' => '',
                        'groupName' => 'contactinformation',
                        'type' => 'string',
                        'fieldType' => 'text',
                        'displayOrder' => 1,
                        'required' => true,
                        'enabled' => true,
                        'hidden' => false,
                        'defaultValue' => '',
                        'isSmartField' => false,
                        'validation' => [
                            'name' => '',
                            'message' => '',
                        ],
                    ],
                ],
                'default' => true,
                'isSmartGroup' => false,
            ],
        ]);
    }

    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->guid);
    }
}
