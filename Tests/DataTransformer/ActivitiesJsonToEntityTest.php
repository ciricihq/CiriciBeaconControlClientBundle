<?php

namespace Cirici\BeaconControlClientBundle\Tests\DataTransformer;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Cirici\BeaconControlClientBundle\Entity\Activity;

class ActivitiesJsonToEntityTest extends WebTestCase
{
    public function testActivitiesCollectionToEntities()
    {
        $collection = json_decode('[{"id":8,"name":"1 - Test from admin edited","scheme":"url","payload":{"url":"http:\/\/cirici.com"},"trigger":{"id":91,"type":"BeaconTrigger","event_type":"enter","beacon_ids":[],"zone_ids":[],"test":false,"dwell_time":5},"custom_attributes":[]},{"id":9,"name":"2 - Test from admin edited","scheme":"url","payload":{"url":"http:\/\/test.com"},"trigger":{"id":92,"type":"BeaconTrigger","event_type":"enter","beacon_ids":[],"zone_ids":[],"test":false,"dwell_time":5},"custom_attributes":[]},{"id":10,"name":"3 - Test from admin edited","scheme":"url","payload":{"url":"http:\/\/whatever.com"},"trigger":{"id":93,"type":"BeaconTrigger","event_type":"enter","beacon_ids":[],"zone_ids":[],"test":false,"dwell_time":5},"custom_attributes":[]},{"id":11,"name":"4 - Test from admin edited","scheme":"url","payload":{"url":"http:\/\/asdfasdfasdf"},"trigger":{"id":94,"type":"BeaconTrigger","event_type":"enter","beacon_ids":[],"zone_ids":[],"test":false,"dwell_time":5},"custom_attributes":[]}]');
        $client = static::makeClient();
        $transformer = $client->getContainer()->get('cirici_beacon_control_client.transformer.activities_json_to_entity');
        $transformedCol = $transformer->activitiesCollectionToEntities($collection);

        $this->assertGreaterThan(0, count($transformedCol));
        $this->assertContainsOnlyInstancesOf(Activity::class, $transformedCol);
    }
}
