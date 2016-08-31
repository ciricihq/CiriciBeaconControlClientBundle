<?php
namespace Cirici\BeaconControlClientBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ActionTypeConstraintValidator extends ConstraintValidator
{
    public function validate($action, Constraint $constraint)
    {
        
        if ($action->getScheme() === 'url' and $action->getUrl() === null)
        {
                $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', "URL")
                ->setParameter('%field%', "Url")
                ->addViolation();
        } else if ($action->getScheme()  === 'push' and $action->getPushMessage() === null)
        {
                $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', "PUSH")
                ->setParameter('%field%', "Push Message")
                ->addViolation();
        }
    }
}