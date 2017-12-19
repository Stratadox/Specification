<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Boxes;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Test\Integration\Boxes\Model\Box;
use Stratadox\Specification\Test\Integration\Boxes\Model\CollectionOfBoxes;
use Stratadox\Specification\Test\Integration\Boxes\Specification\Length\HaveALength;

class B_InvertingSpecificationsTest extends TestCase
{
    /** @test */
    function not_inverts_the_specification()
    {
        $allBoxes = CollectionOfBoxes::containing(
            Box::ofLength(1),
            Box::ofLength(2),
            Box::ofLength(3),
            Box::ofLength(16)
        );

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofLength(1),
                Box::ofLength(3),
                Box::ofLength(16)
            ),
            $allBoxes->that(HaveALength::of(2)->not())
        );
    }
}
