<?php

namespace Cirici\BeaconControlClientBundle\Entity;

use Cirici\BeaconControlClientBundle\Entity\Beacon;

class Activity implements \JsonSerializable
{
    private $id;
    private $name;
    private $url;
    private $triggerConfiguration;
    private $triggerAttributes;
    public $beacons;

    /**
     * __construct
     *
     * @param bool $json
     * @access public
     * @return void
     */
    public function __construct($json = null)
    {
        $this->beacons = [];

        if ($json) {

            if (isset($json->trigger->beacon_ids)) {
                foreach ($json->trigger->beacon_ids as $id) {
                    $beacon = new Beacon();
                    $beacon->setId($id);
                    $this->addBeacon($beacon);
                }
            }

            $this->name = $json->name;
            $this->id = isset($json->id) ? $json->id : null ;
            $this->url = isset($json->url) ? $json->url : null ;
            $this->url = isset($json->payload->url) ? $json->payload->url : null ;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($activityId)
    {
        $this->id = $activityId;
    }

    /**
     * setName
     *
     * @param mixed $name
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * getName
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * setUrl
     *
     * @param mixed $url
     * @access public
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * getUrl
     *
     * @access public
     * @return void
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * addBeacon
     *
     * @param mixed $beacon
     * @access public
     * @return void
     */
    public function addBeacon($beacon)
    {
        $this->beacons[] = $beacon;
    }

    /**
     * getBeacons
     *
     * @access public
     * @return void
     */
    public function getBeacons()
    {
        return $this->beacons;
    }

    /**
     * setTriggerConfiguration
     *
     * @param mixed $triggerConfiguration
     * @access public
     * @return void
     */
    public function setTriggerConfiguration($triggerConfiguration)
    {
        $this->triggerConfiguration = $triggerConfiguration;
    }

    /**
     * getTriggerConfiguration
     *
     * @access public
     * @return TriggerConfiguration
     */
    public function getTriggerConfiguration()
    {
        return $this->triggerConfiguration;
    }

    /**
     * setTriggerAttributes
     *
     * @param mixed $triggerAttributes
     * @access public
     * @return void
     */
    public function  setTriggerAttributes($triggerAttributes)
    {
        $this->triggerAttributes = $triggerAttributes;
    }

    /**
     * getTriggerAttributes
     *
     * @access public
     * @return void
     */
    public function  getTriggerAttributes()
    {
        return $this->triggerAttributes;
    }

    /**
     * jsonSerialize
     *
     * @access public
     * @return json
     */
    public function jsonSerialize() {
        return [
            'name' => $this->getName(),
            'url' => $this->getUrl(),
            'trigger_attributes' => $this->getTriggerAttributes(),
        ];
    }
}
