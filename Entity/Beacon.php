<?php

namespace Cirici\BeaconControlClientBundle\Entity;

class Beacon implements \JsonSerializable
{
    private $id;
    private $name;

    public function __construct($json = null)
    {
        if ($json) {
            $this->id = isset($json->id) ? $json->id : null;
            $this->name = isset($json->name) ? $json->name : null;
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

   public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }
}
