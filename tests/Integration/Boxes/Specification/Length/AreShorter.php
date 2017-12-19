<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Boxes\Specification\Length;

use Stratadox\Specification\Test\Integration\Boxes\Model\Box;

class AreShorter extends LengthSpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Box
            && $object->length() < $this->length;
    }
}
