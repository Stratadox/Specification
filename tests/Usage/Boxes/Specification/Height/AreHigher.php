<?php

namespace Stratadox\Specification\Test\Usage\Boxes\Specification\Height;

use Stratadox\Specification\Test\Usage\Boxes\Model\Box;

class AreHigher extends HeightSpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Box
            && $object->height() > $this->height;
    }
}
