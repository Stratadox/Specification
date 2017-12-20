<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Binary;

/**
 * Checks that either one of conditions is satisfied.
 *
 * @author Stratadox
 * @package Stratadox\Specification
 */
class OrSpecification extends BinarySpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $this->leftIsSatisfiedBy($object)
            || $this->rightIsSatisfiedBy($object);
    }
}
