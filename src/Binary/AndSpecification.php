<?php

namespace Stratadox\Specification\Binary;

class AndSpecification extends BinarySpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $this->leftIsSatisfiedBy($object)
            && $this->rightIsSatisfiedBy($object);
    }
}
