<?php

namespace Stratadox\Specification\Test\Usage\Mysql\Specification;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Specification;
use Stratadox\Specification\Test\Usage\Mysql\Model\Product;

class HaveType extends Specification
{
    private $type;

    public function __construct(int $type)
    {
        $this->type = $type;
    }

    public static function number(int $type) : Specifies
    {
        return new static($type);
    }

    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Product
            && $object->type() === $this->type;
    }

    public function type() : int
    {
        return $this->type;
    }
}
