<?php

namespace Stratadox\Specification\Binary;

use Stratadox\Specification\Specifying;
use Stratadox\Specification\Contract\Satisfiable;
use Stratadox\Specification\Contract\Specifies;

abstract class BinarySpecification implements Specifies
{
    use Specifying;

    private $leftHandCondition;
    private $rightHandCondition;

    public function __construct(
        Satisfiable $leftHandCondition,
        Satisfiable $rightHandCondition
    ) {
        $this->leftHandCondition = $leftHandCondition;
        $this->rightHandCondition = $rightHandCondition;
    }

    public function leftHandCondition() : Satisfiable
    {
        return $this->leftHandCondition;
    }

    public function rightHandCondition() : Satisfiable
    {
        return $this->rightHandCondition;
    }

    protected function leftIsSatisfiedBy($object) : bool
    {
        return $this->leftHandCondition->isSatisfiedBy($object);
    }

    protected function rightIsSatisfiedBy($object) : bool
    {
        return $this->rightHandCondition->isSatisfiedBy($object);
    }
}
