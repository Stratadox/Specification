<?php

namespace Stratadox\Specification\Test\Composition;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Test\Satisfaction\SatisfiedByEverything;
use Stratadox\Specification\Unary\NotSpecification;

class UnaryCompositionTest extends TestCase
{
    /** @test */
    function NotSpecification_provides_access_to_the_object_it_was_constructed_with()
    {
        $condition = new SatisfiedByEverything;
        $specification = new NotSpecification($condition);

        $this->assertSame(
            $condition,
            $specification->condition()
        );
    }
}
