<?php

declare(strict_types = 1);

namespace Stratadox\Specification;

use Stratadox\Specification\Binary\AndSpecification;
use Stratadox\Specification\Binary\OrSpecification;
use Stratadox\Specification\Binary\XorSpecification;
use Stratadox\Specification\Contract\Satisfiable;
use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Unary\NotSpecification;

trait Specifying
{
    /** @see Specifies::not() */
    public function not() : Specifies
    {
        /** @var Specifying|Satisfiable $this */
        return $this->doesNotSatisfy($this);
    }

    /** @see Specifies::and() */
    public function and(Satisfiable $other) : Specifies
    {
        /** @var Specifying|Satisfiable $this */
        return $this->satisfiesBoth($this, $other);
    }

    /** @see Specifies::or() */
    public function or(Satisfiable $other) : Specifies
    {
        /** @var Specifying|Satisfiable $this */
        return $this->oneOfThese($this, $other);
    }

    /** @see Specifies::xor() */
    public function xor(Satisfiable $other) : Specifies
    {
        /** @var Specifying|Satisfiable $this */
        return new XorSpecification($this, $other);
    }

    /** @see Specifies::nor() */
    public function nor(Satisfiable $other) : Specifies
    {
        return $this->not()->andNot($other);
    }

    /** @see Specifies::andNot() */
    public function andNot(Satisfiable $other) : Specifies
    {
        return $this->and($this->doesNotSatisfy($other));
    }

    /** @see Specifies::butNot() */
    public function butNot(Satisfiable $other) : Specifies
    {
        return $this->andNot($other);
    }

    /** @see Specifies::orNot() */
    public function orNot(Satisfiable $other) : Specifies
    {
        return $this->or($this->doesNotSatisfy($other));
    }


    // Private


    private function doesNotSatisfy(Satisfiable $condition) : Specifies
    {
        return new NotSpecification($condition);
    }

    private function satisfiesBoth(Satisfiable $firstCondition, Satisfiable $secondCondition) : Specifies
    {
        return new AndSpecification($firstCondition, $secondCondition);
    }

    private function oneOfThese(Satisfiable $firstCondition, Satisfiable $secondCondition) : Specifies
    {
        return new OrSpecification($firstCondition, $secondCondition);
    }
}
