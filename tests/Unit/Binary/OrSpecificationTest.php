<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Unit\Binary;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Binary\OrSpecification;
use Stratadox\Specification\Test\Unit\SatisfiedByEverything;
use Stratadox\Specification\Test\Unit\SatisfiedByNothing;

class OrSpecificationTest extends TestCase
{
    /** @test */
    function pass_when_both_conditions_are_satisfied()
    {
        $both = new OrSpecification(new SatisfiedByEverything, new SatisfiedByEverything);
        $this->assertTrue($both->isSatisfiedBy($this));
    }

    /** @test */
    function pass_when_only_the_first_condition_is_satisfied()
    {
        $both = new OrSpecification(new SatisfiedByEverything, new SatisfiedByNothing);
        $this->assertTrue($both->isSatisfiedBy($this));
    }

    /** @test */
    function pass_when_only_the_second_condition_is_satisfied()
    {
        $both = new OrSpecification(new SatisfiedByNothing, new SatisfiedByEverything);
        $this->assertTrue($both->isSatisfiedBy($this));
    }

    /** @test */
    function fail_when_no_conditions_are_satisfied()
    {
        $both = new OrSpecification(new SatisfiedByNothing, new SatisfiedByNothing);
        $this->assertFalse($both->isSatisfiedBy($this));
    }

    /** @test */
    function provide_access_to_the_conditions()
    {
        $leftHandCondition = new SatisfiedByEverything;
        $rightHandCondition = new SatisfiedByNothing;
        $specification = new OrSpecification(
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
