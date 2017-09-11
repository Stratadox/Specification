<?php

namespace Stratadox\Specification\Test\Usage\Boxes\Specification\Weight;

use Stratadox\Specification\Test\Usage\Boxes\Model\Box;

class AreLighter extends WeightSpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Box
            && $object->weight() < $this->weight;
    }
}
