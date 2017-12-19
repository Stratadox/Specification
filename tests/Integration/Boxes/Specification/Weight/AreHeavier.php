<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Boxes\Specification\Weight;

use Stratadox\Specification\Test\Integration\Boxes\Model\Box;

class AreHeavier extends WeightSpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Box
            && $object->weight() > $this->weight;
    }
}
