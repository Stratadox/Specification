<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Boxes\Specification\Colour;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Specification;
use Stratadox\Specification\Test\Integration\Boxes\Model\Box;

class AreColoured extends Specification
{
    private $colour;

    public function __construct(string $colour)
    {
        $this->colour = $colour;
    }

    public static function mostly(string $colour) : Specifies
    {
        return new static($colour);
    }

    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Box
            && $object->colour() === $this->colour;
    }
}
