<?php
namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\CompanyProperties;

class CompanyPropertyGroupsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CompanyProperties $companyProperties
     */
    protected $companyProperties;
    
    /**
     * @var \SevenShores\Hubspot\Http\Response $task
     */
    protected $group;

    public function setUp()
    {
        parent::setUp();
        $this->companyProperties = new CompanyProperties(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
        $this->group = $this->createCompanyPropertyGroup();
    }
    
    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->group)) {
            $this->companyProperties->deleteGroup($this->group->name);
        }
    }
    
    /** @test */
    public function all()
    {
        $response = $this->companyProperties->getAllGroups();
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
        $this->assertObjectNotHasAttribute('properties', $response->getData()[0]);
    }
    
    /** @test */
    public function allWithProperties()
    {
        $response = $this->companyProperties->getAllGroups(true);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
        $this->assertObjectHasAttribute('properties', $response->getData()[0]);
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->group->getStatusCode());
        $this->assertEquals('A New Custom Group', $this->group->displayName);
    }

    /** @test */
    public function update()
    {
        $group = [
            'displayName' => 'An Updated Company Property Group',
            'displayOrder' => 7,
        ];

        $response = $this->companyProperties->updateGroup($this->group->name, $group);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('An Updated Company Property Group', $response->displayName);
    }

    /** @test */
    public function delete()
    {
        $response = $this->companyProperties->deleteGroup($this->group->name);

        $this->assertEquals(204, $response->getStatusCode());
        
        $this->group = null;
    }
    
    /**
     * Creates a new company property group.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createCompanyPropertyGroup()
    {
        $data = [
            'name' => 't'.uniqid(),
            'displayName' => 'A New Custom Group',
            'displayOrder' => 7,
        ];

        return $this->companyProperties->createGroup($data);
    }
}
