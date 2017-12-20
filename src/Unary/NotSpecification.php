<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Unary;

/**
 * Checks that the condition is not satisfied.
 *
 * @author Stratadox
 * @package Stratadox\Specification
 */
class NotSpecification extends UnarySpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return !$this->conditionIsSatisfiedBy($object);
    }
}
