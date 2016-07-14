<?php

namespace Cirici\BeaconControlClientBundle\DataTransformer;

use Cirici\BeaconControlClientBundle\Entity\Activity;

class ActivitiesJsonToEntity
{
    /**
     * beaconsCollectionToEntities
     *
     * @param mixed $jsoncol
     * @access public
     * @return array
     */
    public function activitiesCollectionToEntities($jsoncol)
    {
        $result = [];
        foreach ($jsoncol as $activity) {
            $result[] = new Activity($activity);
        }

        return $result;
    }
}
