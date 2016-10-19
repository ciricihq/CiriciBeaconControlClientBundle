<?php

namespace Cirici\BeaconControlClientBundle\Entity;

class TriggerConfiguration implements \JsonSerializable
{
    private $id;
    private $type;
    private $event_type;
    private $dwell_time;
    private $beacon_ids;
    private $test;

    /**
     * __construct
     *
     * @param bool $json
     * @access public
     * @return void
     */
    public function __construct($json = null)
    {
        if ($json) {
            $this->id = isset($json->id) ? $json->id : null ;
            $this->type = isset($json->type) ? $json->type : null ;
            $this->event_type = isset($json->event_type) ? $json->event_type : null ;
            $this->dwell_time  = isset($json->dwell_time) ? $json->dwell_time : null ;
            $this->beacon_ids  = isset($json->beacon_ids) ? $json->beacon_ids : null ;
            $this->test  = isset($json->test) ? $json->test : null ;
        }
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getEventType()
    {
        return $this->event_type;
    }

    public function setEventType($eventType)
    {
        $this->event_type = $eventType;
    }

    public function getDwellTime()
    {
        return $this->dwell_time;
    }

    public function setDwellTime($dwellTime)
    {
        $this->dwell_time = $dwellTime;
    }

    public function getBeaconIds()
    {
        return $this->beacon_ids;
    }

    public function setBeaconIds($beaconIds)
    {
        $this->beacon_ids = $beaconIds;
    }

    public function getTest()
    {
        return $this->test;
    }

    public function setTest($test)
    {
        $this->test = $test;
    }

    /**
     * jsonSerialize
     *
     * @access public
     * @return json
     */
    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'event_type' => $this->event_type,
            'dwell_time' => $this->dwell_time,
            'beacon_ids' => $this->beacon_ids,
            'test' => $this->test,
        ];
    }
}
