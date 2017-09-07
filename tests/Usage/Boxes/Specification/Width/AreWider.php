<?php

namespace Stratadox\Specification\Test\Usage\Boxes\Specification\Width;

use Stratadox\Specification\Test\Usage\Boxes\Model\Box;

class AreWider extends WidthSpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Box
            && $object->width() > $this->width;
    }
}
