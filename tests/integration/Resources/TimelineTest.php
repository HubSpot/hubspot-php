<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Timeline;

class TimelineTest extends \PHPUint_Framework_TestCase
{
    /**
     * @var Timeline
     */
    protected $timeline;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->timeline = new Timeline(new Client(['key' => 'demo']));
        sleep(1);
    }
}
