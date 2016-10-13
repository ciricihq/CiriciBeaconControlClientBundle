<?php

namespace Cirici\BeaconControlClientBundle\Entity;

use Cirici\BeaconControlClientBundle\Entity\Beacon;
use Cirici\BeaconControlClientBundle\Validator\Constraints\ActionTypeConstraint;

/**
 * @ActionTypeConstraint
 */
class Activity implements \JsonSerializable
{
    private $id;
    private $name;
    private $url;
    private $triggerConfiguration;
    private $triggerAttributes;
    public $beacons;

    private $scheme;
    private $pushMessage;

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
            $this->scheme = isset($json->scheme) ? $json->scheme : null ;
            $this->pushMessage = isset($json->pushMessage) ? $json->pushMessage : null ;
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

    public function getBeaconsIds()
    {
        $result = [];
        foreach ($this->beacons as $beacon) {
            $result[] = $beacon->getId();
        }

        return $result;
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
     * getScheme
     *
     * @access public
     * @return scheme
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * setScheme
     *
     * @param mixed $scheme
     * @access public
     * @return void
     */
    public function  setScheme($scheme)
    {
        $this->scheme = $scheme;
    }

    /**
     * getPushMessage
     *
     * @access public
     * @return pushMessage
     */
    public function getPushMessage()
    {
        return $this->pushMessage;
    }

    /**
     * setPushMessage
     *
     * @param mixed $pushMessage
     * @access public
     * @return void
     */
    public function  setPushMessage($pushMessage)
    {
        $this->pushMessage = $pushMessage;
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
            'scheme' => $this->getScheme(),
            'trigger_attributes' => $this->getTriggerAttributes(),
        ];
    }
}
