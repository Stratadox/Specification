<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Binary;

/**
 * Checks that both conditions are satisfied.
 *
 * @author Stratadox
 * @package Stratadox\Specification
 */
class AndSpecification extends BinarySpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $this->leftIsSatisfiedBy($object)
            && $this->rightIsSatisfiedBy($object);
    }
}
