<?php

namespace Stratadox\Specification\Test\Usage\Boxes;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Test\Usage\Boxes\Model\Box;
use Stratadox\Specification\Test\Usage\Boxes\Model\CollectionOfBoxes;
use Stratadox\Specification\Test\Usage\Boxes\Specification\Colour\AreColoured;
use Stratadox\Specification\Test\Usage\Boxes\Specification\Weight\AreHeavier;
use Stratadox\Specification\Test\Usage\Boxes\Specification\Weight\AreLighter;

class C_CombiningSpecificationsTest extends TestCase
{
    /** @test */
    function and_requires_both_conditions_to_be_satisfied()
    {
        $allBoxes = CollectionOfBoxes::containing(
            Box::ofWeight(1),
            Box::ofWeight(2),
            Box::ofWeight(3),
            Box::ofWeight(5),
            Box::ofWeight(26)
        );

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofWeight(3),
                Box::ofWeight(5)
            ),
            $allBoxes->that(AreHeavier::than(2)->and(AreLighter::than(10)))
        );
    }

    /** @test */
    function or_requires_either_or_both_conditions_to_be_satisfied()
    {
        $allBoxes = CollectionOfBoxes::containing(
            Box::ofColour('yellow'),
            Box::ofColour('red'),
            Box::ofColour('green'),
            Box::ofColour('blue'),
            Box::ofColour('orange'),
            Box::ofColour('red'),
            Box::ofColour('purple')
        );

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofColour('red'),
                Box::ofColour('green'),
                Box::ofColour('red')
            ),
            $allBoxes->that(AreColoured::mostly('red')->or(AreColoured::mostly('green')))
        );
    }

    /** @test */
    function nor_requires_neither_condition_to_be_satisfied()
    {
        $allBoxes = CollectionOfBoxes::containing(
            Box::ofColour('yellow'),
            Box::ofColour('red'),
            Box::ofColour('green'),
            Box::ofColour('blue'),
            Box::ofColour('orange'),
            Box::ofColour('red'),
            Box::ofColour('purple')
        );

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofColour('yellow'),
                Box::ofColour('blue'),
                Box::ofColour('orange'),
                Box::ofColour('purple')
            ),
            $allBoxes->that(AreColoured::mostly('red')->nor(AreColoured::mostly('green')))
        );
    }

    /** @test */
    function xor_requires_either_but_not_both_conditions_to_be_satisfied()
    {
        $allBoxes = CollectionOfBoxes::containing(
            Box::ofWeight(3),
            Box::ofWeight(26),
            Box::ofWeight(5),
            Box::ofColourAndWeight('red', 15),
            Box::ofColourAndWeight('red', 5),
            Box::ofColourAndWeight('pink', 7)
        );

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofWeight(26),
                Box::ofColourAndWeight('red', 5)
            ),
            $allBoxes->that(AreHeavier::than(10)->xor(AreColoured::mostly('red')))
        );
    }

    /** @test */
    function andNot_requires_the_first_but_not_the_second_condition_to_be_satisfied()
    {
        $allBoxes = CollectionOfBoxes::containing(
            Box::ofColourAndWeight('red', 15),
            Box::ofColourAndWeight('magenta', 5),
            Box::ofColourAndWeight('pink', 17),
            Box::ofColourAndWeight('turquoise', 4),
            Box::ofColourAndWeight('gold', 999),
            Box::ofColourAndWeight('red', 2),
            Box::ofColourAndWeight('orange', 11),
            Box::ofColourAndWeight('white', 10)
        );

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofColourAndWeight('pink', 17),
                Box::ofColourAndWeight('gold', 999),
                Box::ofColourAndWeight('orange', 11)
            ),
            $allBoxes->that(AreHeavier::than(10)->andNot(AreColoured::mostly('red')))
        );
    }

    /** @test */
    function butNot_requires_the_first_but_not_the_second_condition_to_be_satisfied()
    {
        $allBoxes = CollectionOfBoxes::containing(
            Box::ofColourAndWeight('red', 15),
            Box::ofColourAndWeight('magenta', 5),
            Box::ofColourAndWeight('pink', 17),
            Box::ofColourAndWeight('turquoise', 4),
            Box::ofColourAndWeight('gold', 999),
            Box::ofColourAndWeight('red', 2),
            Box::ofColourAndWeight('orange', 11),
            Box::ofColourAndWeight('white', 10)
        );

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofColourAndWeight('pink', 17),
                Box::ofColourAndWeight('gold', 999),
                Box::ofColourAndWeight('orange', 11)
            ),
            $allBoxes->that(AreHeavier::than(10)->butNot(AreColoured::mostly('red')))
        );
    }

    /** @test */
    function orNot_requires_the_first_condition_to_be_satisfied_or_the_second_not_to_be_satisfied()
    {
        $allBoxes = CollectionOfBoxes::containing(
            Box::ofColourAndWeight('red', 15),
            Box::ofColourAndWeight('magenta', 5),
            Box::ofColourAndWeight('pink', 17),
            Box::ofColourAndWeight('turquoise', 4),
            Box::ofColourAndWeight('gold', 999),
            Box::ofColourAndWeight('red', 2),
            Box::ofColourAndWeight('orange', 11),
            Box::ofColourAndWeight('white', 10)
        );

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofColourAndWeight('red', 15),
                Box::ofColourAndWeight('magenta', 5),
                Box::ofColourAndWeight('pink', 17),
                Box::ofColourAndWeight('turquoise', 4),
                Box::ofColourAndWeight('gold', 999),
                Box::ofColourAndWeight('orange', 11),
                Box::ofColourAndWeight('white', 10)
            ),
            $allBoxes->that(AreHeavier::than(10)->orNot(AreColoured::mostly('red')))
        );
    }
}
