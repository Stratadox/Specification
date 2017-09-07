<?php

namespace Stratadox\Specification\Test\Satisfaction\Unary;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Test\Satisfaction\SatisfiedByEverything;
use Stratadox\Specification\Test\Satisfaction\SatisfiedByNothing;
use Stratadox\Specification\Unary\NotSpecification;

class NotSpecificationTest extends TestCase
{
    /** @test */
    function everything_not_is_nothing()
    {
        $never = new NotSpecification(new SatisfiedByEverything);

        $this->assertFalse($never->isSatisfiedBy($this));
    }

    /** @test */
    function nothing_not_is_everything()
    {
        $always = new NotSpecification(new SatisfiedByNothing);

        $this->assertTrue($always->isSatisfiedBy($this));
    }
}
