<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Boxes\Specification\Length;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Specification;

abstract class LengthSpecification extends Specification
{
    protected $length;

    public function __construct(int $length)
    {
        $this->length = $length;
    }

    public static function than(int $length) : Specifies
    {
        return new static($length);
    }
}
