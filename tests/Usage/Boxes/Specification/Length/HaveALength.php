<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Usage\Boxes\Specification\Length;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Test\Usage\Boxes\Model\Box;

class HaveALength extends LengthSpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Box
            && $object->length() === $this->length;
    }

    public static function of(int $length) : Specifies
    {
        return new static($length);
    }
}
