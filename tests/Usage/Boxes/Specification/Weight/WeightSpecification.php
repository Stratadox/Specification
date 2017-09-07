<?php

namespace Stratadox\Specification\Test\Usage\Boxes\Specification\Weight;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Specification;

abstract class WeightSpecification extends Specification
{
    protected $weight;

    public function __construct(int $weight)
    {
        $this->weight = $weight;
    }

    public static function than(int $weight) : Specifies
    {
        return new static($weight);
    }
}
