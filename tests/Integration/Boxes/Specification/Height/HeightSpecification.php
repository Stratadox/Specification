<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Boxes\Specification\Height;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Specification;

abstract class HeightSpecification extends Specification
{
    protected $height;

    public function __construct(int $height)
    {
        $this->height = $height;
    }

    public static function than(int $height) : Specifies
    {
        return new static($height);
    }
}
