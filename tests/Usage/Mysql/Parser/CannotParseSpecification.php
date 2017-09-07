<?php

namespace Stratadox\Specification\Test\Usage\Mysql\Parser;

use InvalidArgumentException;
use Stratadox\Specification\Contract\Satisfiable;

class CannotParseSpecification extends InvalidArgumentException
{
    public static function noImplementationFor(Satisfiable $specification) : CannotParseSpecification
    {
        return new static(sprintf(
            'Cannot parse the mysql for `%s`: No implementation provided.',
            get_class($specification)
        ));
    }
}
