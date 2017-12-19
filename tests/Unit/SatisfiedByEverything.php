<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Unit;

use Stratadox\Specification\Contract\Satisfiable;

class SatisfiedByEverything implements Satisfiable
{
    public function isSatisfiedBy($object) : bool
    {
        return true;
    }
}