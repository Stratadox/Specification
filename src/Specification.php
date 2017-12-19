<?php

declare(strict_types = 1);

namespace Stratadox\Specification;

use Stratadox\Specification\Contract\Specifies;

abstract class Specification implements Specifies
{
    use Specifying;
}
