<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Binary;

class OrSpecification extends BinarySpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $this->leftIsSatisfiedBy($object)
            || $this->rightIsSatisfiedBy($object);
    }
}
