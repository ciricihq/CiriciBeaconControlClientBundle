<?php

namespace Cirici\BeaconControlClientBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ActionTypeConstraint extends Constraint
{
    public $message = 'For the action type "%string%" you need to fill the %field% field.';

    public function getTargets()
    {
        return Constraint::CLASS_CONSTRAINT;
    }
}