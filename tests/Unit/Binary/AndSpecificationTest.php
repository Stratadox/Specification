<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Unit\Binary;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Binary\AndSpecification;
use Stratadox\Specification\Test\Unit\SatisfiedByEverything;
use Stratadox\Specification\Test\Unit\SatisfiedByNothing;

class AndSpecificationTest extends TestCase
{
    /** @test */
    function pass_when_both_conditions_are_satisfied()
    {
        $both = new AndSpecification(new SatisfiedByEverything, new SatisfiedByEverything);
        $this->assertTrue($both->isSatisfiedBy($this));
    }

    /** @test */
    function fail_when_only_the_first_condition_is_satisfied()
    {
        $both = new AndSpecification(new SatisfiedByEverything, new SatisfiedByNothing);
        $this->assertFalse($both->isSatisfiedBy($this));
    }

    /** @test */
    function fail_when_only_the_second_condition_is_satisfied()
    {
        $both = new AndSpecification(new SatisfiedByNothing, new SatisfiedByEverything);
        $this->assertFalse($both->isSatisfiedBy($this));
    }

    /** @test */
    function fail_when_no_conditions_are_satisfied()
    {
        $both = new AndSpecification(new SatisfiedByNothing, new SatisfiedByNothing);
        $this->assertFalse($both->isSatisfiedBy($this));
    }

    /** @test */
    function provide_access_to_the_conditions()
    {
        $leftHandCondition = new SatisfiedByEverything;
        $rightHandCondition = new SatisfiedByNothing;
        $specification = new AndSpecification(
            $leftHandCondition,
            $rightHandCondition
        );

        $this->assertSame(
            $leftHandCondition,
            $specification->leftHandCondition()
        );
        $this->assertSame(
            $rightHandCondition,
            $specification->rightHandCondition()
        );
    }
}