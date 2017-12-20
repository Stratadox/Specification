<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Unit\Composition;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Binary\AndSpecification;
use Stratadox\Specification\Binary\OrSpecification;
use Stratadox\Specification\Binary\XorSpecification;
use Stratadox\Specification\Test\Unit\Name;
use Stratadox\Specification\Unary\NotSpecification;

class Specifications_can_be_composed_through_methods extends TestCase
{
    /** @test */
    function not_results_in_a_NotSpecification()
    {
        $this->assertEquals(
            new NotSpecification(new Name('Foo')),
            Name::is('Foo')->not()
        );
    }

    /** @test */
    function and_results_in_an_AndSpecification()
    {
        $this->assertEquals(
            new AndSpecification(new Name('Foo'), new Name('Bar')),
            Name::is('Foo')->and(Name::is('Bar'))
        );
    }

    /** @test */
    function or_results_in_an_OrSpecification()
    {
        $this->assertEquals(
            new OrSpecification(new Name('Foo'), new Name('Bar')),
            Name::is('Foo')->or(Name::is('Bar'))
        );
    }

    /** @test */
    function xor_results_in_a_XorSpecification()
    {
        $this->assertEquals(
            new XorSpecification(new Name('Foo'), new Name('Bar')),
            Name::is('Foo')->xor(Name::is('Bar'))
        );
    }

    /** @test */
    function nor_results_in_an_AndSpecification_with_two_NotSpecifications()
    {
        $this->assertEquals(
            new AndSpecification(
                new NotSpecification(new Name('Foo')),
                new NotSpecification(new Name('Bar'))
            ),
            Name::is('Foo')->nor(Name::is('Bar'))
        );
    }

    /** @test */
    function andNot_results_in_an_AndSpecification_with_a_NotSpecification()
    {
        $this->assertEquals(
            new AndSpecification(
                new Name('Foo'),
                new NotSpecification(new Name('Bar'))
            ),
            Name::is('Foo')->andNot(Name::is('Bar'))
        );
    }

    /** @test */
    function butNot_results_in_an_AndSpecification_with_a_NotSpecification()
    {
        $this->assertEquals(
            new AndSpecification(
                new Name('Foo'),
                new NotSpecification(new Name('Bar'))
            ),
            Name::is('Foo')->butNot(Name::is('Bar'))
        );
    }

    /** @test */
    function orNot_results_in_an_OrSpecification_with_a_NotSpecification()
    {
        $this->assertEquals(
            new OrSpecification(
                new Name('Foo'),
                new NotSpecification(new Name('Bar'))
            ),
            Name::is('Foo')->orNot(Name::is('Bar'))
        );
    }
}
