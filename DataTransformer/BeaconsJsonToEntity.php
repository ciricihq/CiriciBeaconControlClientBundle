<?php

namespace Cirici\BeaconControlClientBundle\DataTransformer;

use Cirici\BeaconControlClientBundle\Entity\Beacon;

class BeaconsJsonToEntity
{
    /**
     * beaconsCollectionToEntities
     *
     * @param mixed $jsoncol
     * @access public
     * @return array
     */
    public function beaconsCollectionToEntities($jsoncol)
    {
        $result = [];
        foreach ($jsoncol->ranges as $beacon) {
            $result[] = new Beacon($beacon);
        }

        return $result;
    }
}
