<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Unit\Unary;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Test\Unit\Passed;
use Stratadox\Specification\Test\Unit\Failed;
use Stratadox\Specification\Unary\NotSpecification;

/**
 * @covers \Stratadox\Specification\Unary\NotSpecification
 * @covers \Stratadox\Specification\Unary\UnarySpecification
 */
class NotSpecificationTest extends TestCase
{
    /** @test */
    function fail_passing_conditions()
    {
        $never = new NotSpecification(new Passed);

        $this->assertFalse($never->isSatisfiedBy($this));
    }

    /** @test */
    function pass_failing_conditions()
    {
        $always = new NotSpecification(new Failed);

        $this->assertTrue($always->isSatisfiedBy($this));
    }

    /** @test */
    function provide_access_to_the_condition()
    {
        $condition = new Passed;
        $specification = new NotSpecification($condition);

        $this->assertSame(
            $condition,
            $specification->condition()
        );
    }
}
