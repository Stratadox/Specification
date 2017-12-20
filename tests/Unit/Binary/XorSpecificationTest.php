<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Unit\Binary;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Binary\XorSpecification;
use Stratadox\Specification\Test\Unit\Passed;
use Stratadox\Specification\Test\Unit\Failed;

class XorSpecificationTest extends TestCase
{
    /** @test */
    function fail_when_both_conditions_are_satisfied()
    {
        $both = new XorSpecification(new Passed, new Passed);
        $this->assertFalse($both->isSatisfiedBy($this));
    }

    /** @test */
    function pass_when_only_the_first_condition_is_satisfied()
    {
        $both = new XorSpecification(new Passed, new Failed);
        $this->assertTrue($both->isSatisfiedBy($this));
    }

    /** @test */
    function pass_when_only_the_second_condition_is_satisfied()
    {
        $both = new XorSpecification(new Failed, new Passed);
        $this->assertTrue($both->isSatisfiedBy($this));
    }

    /** @test */
    function fail_when_no_conditions_are_satisfied()
    {
        $both = new XorSpecification(new Failed, new Failed);
        $this->assertFalse($both->isSatisfiedBy($this));
    }

    /** @test */
    function provide_access_to_the_conditions()
    {
        $leftHandCondition = new Passed;
        $rightHandCondition = new Failed;
        $specification = new XorSpecification(
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
