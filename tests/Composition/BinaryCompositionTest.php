<?php

namespace Stratadox\Specification\Test\Composition;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Binary\AndSpecification;
use Stratadox\Specification\Binary\OrSpecification;
use Stratadox\Specification\Binary\XorSpecification;
use Stratadox\Specification\Test\Satisfaction\SatisfiedByEverything;
use Stratadox\Specification\Test\Satisfaction\SatisfiedByNothing;

class BinaryCompositionTest extends TestCase
{
    /** @test */
    function AndSpecification_provides_access_to_the_two_objects_it_was_constructed_with()
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

    /** @test */
    function OrSpecification_provides_access_to_the_two_objects_it_was_constructed_with()
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

    /** @test */
    function XorSpecification_provides_access_to_the_two_objects_it_was_constructed_with()
    {
        $leftHandCondition = new SatisfiedByEverything;
        $rightHandCondition = new SatisfiedByNothing;
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
