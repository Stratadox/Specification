<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Usage\Boxes;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Test\Usage\Boxes\Model\Box;
use Stratadox\Specification\Test\Usage\Boxes\Model\CollectionOfBoxes;
use Stratadox\Specification\Test\Usage\Boxes\Specification\Colour\AreColoured;
use Stratadox\Specification\Test\Usage\Boxes\Specification\Weight\AreHeavier;

class A_SelectionBySpecificationTest extends TestCase
{
    /** @test */
    function selects_boxes_heavier_than_two()
    {
        $allBoxes = CollectionOfBoxes::containing(
            Box::ofWeight(1),
            Box::ofWeight(2),
            Box::ofWeight(3),
            Box::ofWeight(4)
        );

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofWeight(3),
                Box::ofWeight(4)
            ),
            $allBoxes->that(AreHeavier::than(2))
        );
    }

    /** @test */
    function selects_red_boxes()
    {
        $allBoxes = CollectionOfBoxes::containing(
            Box::ofColour('red'),
            Box::ofColour('green'),
            Box::ofColour('blue'),
            Box::ofColour('red')
        );

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofColour('red'),
                Box::ofColour('red')
            ),
            $allBoxes->that(AreColoured::mostly('red'))
        );
    }
}
