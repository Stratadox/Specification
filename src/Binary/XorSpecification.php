<?php

namespace Stratadox\Specification\Binary;

class XorSpecification extends BinarySpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $this->leftIsSatisfiedBy($object)
            xor $this->rightIsSatisfiedBy($object);
    }
}
