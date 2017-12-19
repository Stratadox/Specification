<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Unary;

use Stratadox\Specification\Specifying;
use Stratadox\Specification\Contract\Satisfiable;
use Stratadox\Specification\Contract\Specifies;

abstract class UnarySpecification implements Specifies
{
    use Specifying;

    private $condition;

    public function __construct(Satisfiable $condition)
    {
        $this->condition = $condition;
    }

    protected function conditionIsSatisfiedBy($object) : bool
    {
        return $this->condition->isSatisfiedBy($object);
    }

    public function condition() : Satisfiable
    {
        return $this->condition;
    }
}
