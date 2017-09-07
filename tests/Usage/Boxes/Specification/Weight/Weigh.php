<?php

namespace Stratadox\Specification\Test\Usage\Boxes\Specification\Weight;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Test\Usage\Boxes\Model\Box;

class Weigh extends WeightSpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Box
            && $object->weight() === $this->weight;
    }

    public static function exactly(int $weight) : Specifies
    {
        return new static($weight);
    }
}
