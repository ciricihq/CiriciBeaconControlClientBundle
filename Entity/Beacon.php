<?php

namespace Cirici\BeaconControlClientBundle\Entity;

class Beacon implements \JsonSerializable
{
    private $id;
    private $name;
    private $location;
    private $major;
    private $minor;

    public function __construct($json = null)
    {
        if ($json) {
            $this->id = isset($json->id) ? $json->id : null;
            $this->name = isset($json->name) ? $json->name : null;
            $this->location = isset($json->location) ? $json->location: null;
            $this->major = isset($json->major) ? $json->major : null;
            $this->minor = isset($json->minor) ? $json->minor : null;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getMajor()
    {
        return $this->major;
    }

    public function setMajor($major)
    {
        $this->major = $major;
    }

    public function getMinor()
    {
        return $this->minor;
    }

    public function setMinor($minor)
    {
        $this->minor = $minor;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'location' => $this->getLocation(),
            'major' => $this->getMajor(),
            'minor' => $this->getMinor()
        ];
    }
}
