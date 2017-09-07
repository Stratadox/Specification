<?php

namespace Stratadox\Specification\Unary;

class NotSpecification extends UnarySpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return !$this->conditionIsSatisfiedBy($object);
    }
}
