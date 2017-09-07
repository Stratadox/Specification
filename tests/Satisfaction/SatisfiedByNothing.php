<?php

namespace Stratadox\Specification\Test\Satisfaction;

use Stratadox\Specification\Contract\Satisfiable;

class SatisfiedByNothing implements Satisfiable
{
    public function isSatisfiedBy($object) : bool
    {
        return false;
    }
}
