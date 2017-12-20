<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Unit;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Specification;

class Name extends Specification
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function is(string $name) : Specifies
    {
        return new static($name);
    }

    public function isSatisfiedBy($object) : bool
    {
        return method_exists($object, 'name')
            && $object->name() === $this->name;
    }
}
