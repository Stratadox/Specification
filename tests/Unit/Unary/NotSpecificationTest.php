<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Unit\Unary;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Test\Unit\SatisfiedByEverything;
use Stratadox\Specification\Test\Unit\SatisfiedByNothing;
use Stratadox\Specification\Unary\NotSpecification;

class NotSpecificationTest extends TestCase
{
    /** @test */
    function fail_passing_conditions()
    {
        $never = new NotSpecification(new SatisfiedByEverything);

        $this->assertFalse($never->isSatisfiedBy($this));
    }

    /** @test */
    function pass_failing_conditions()
    {
        $always = new NotSpecification(new SatisfiedByNothing);

        $this->assertTrue($always->isSatisfiedBy($this));
    }

    /** @test */
    function provide_access_to_the_condition()
    {
        $condition = new SatisfiedByEverything;
        $specification = new NotSpecification($condition);

        $this->assertSame(
            $condition,
            $specification->condition()
        );
    }
}
