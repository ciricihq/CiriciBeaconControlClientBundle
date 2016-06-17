<?php

namespace Cirici\BeaconControlClientBundle\Entity;

class Beacon implements \JsonSerializable
{
    private $id;
    private $name;
    private $location;

    public function __construct($json = null)
    {
        if ($json) {
            $this->id = isset($json->id) ? $json->id : null;
            $this->name = isset($json->name) ? $json->name : null;
            $this->location = isset($json->location) ? $json->location: null;
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

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'location' => $this->getLocation()
        ];
    }
}
