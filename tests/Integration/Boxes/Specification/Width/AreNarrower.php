<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Boxes\Specification\Width;

use Stratadox\Specification\Test\Integration\Boxes\Model\Box;

class AreNarrower extends WidthSpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Box
            && $object->width() < $this->width;
    }
}
