<?php

namespace Stratadox\Specification\Test\Usage\Boxes\Specification\Width;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Specification;

abstract class WidthSpecification extends Specification
{
    protected $width;

    public function __construct(int $width)
    {
        $this->width = $width;
    }

    public static function than(int $width) : Specifies
    {
        return new static($width);
    }
}
