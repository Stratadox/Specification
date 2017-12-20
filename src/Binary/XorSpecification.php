<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Binary;

/**
 * Checks that exactly one of conditions is satisfied.
 *
 * @author Stratadox
 * @package Stratadox\Specification
 */
class XorSpecification extends BinarySpecification
{
    public function isSatisfiedBy($object) : bool
    {
        return $this->leftIsSatisfiedBy($object)
            xor $this->rightIsSatisfiedBy($object);
    }
}
