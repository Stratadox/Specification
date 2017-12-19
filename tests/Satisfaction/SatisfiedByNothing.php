<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Satisfaction;

use Stratadox\Specification\Contract\Satisfiable;

class SatisfiedByNothing implements Satisfiable
{
    public function isSatisfiedBy($object) : bool
    {
        return false;
    }
}
