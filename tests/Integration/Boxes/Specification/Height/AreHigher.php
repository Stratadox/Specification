<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Boxes\Specification\Height;

use Stratadox\Specification\Test\Integration\Boxes\Model\Box;

class AreHigher extends HeightSpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Box
            && $object->height() > $this->height;
    }
}
