<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Boxes;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Specification;
use Stratadox\Specification\Test\Integration\Boxes\Model\Box;
use Stratadox\Specification\Test\Integration\Boxes\Model\CollectionOfBoxes;
use Stratadox\Specification\Test\Integration\Boxes\Specification\Height\AreHigher;
use Stratadox\Specification\Test\Integration\Boxes\Specification\Height\AreLower;
use Stratadox\Specification\Test\Integration\Boxes\Specification\Length\AreLonger;
use Stratadox\Specification\Test\Integration\Boxes\Specification\Length\AreShorter;
use Stratadox\Specification\Test\Integration\Boxes\Specification\Weight\AreHeavier;
use Stratadox\Specification\Test\Integration\Boxes\Specification\Weight\AreLighter;
use Stratadox\Specification\Test\Integration\Boxes\Specification\Width\AreNarrower;
use Stratadox\Specification\Test\Integration\Boxes\Specification\Width\AreWider;

class D_ReusingSpecificationsTest extends TestCase
{
    /**
     * @test
     * @dataProvider warehouseFullOfBoxes
     */
    function specifications_can_be_grouped(
        CollectionOfBoxes $allBoxes
    ) {
        $areNotTooLarge = AreNarrower::than(10)
            ->and(AreLower::than(10))
            ->and(AreShorter::than(10));

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofSizeAndWeight(5, 7, 8, 90, 'white'),
                Box::ofSizeAndWeight(3, 2, 5, 40, 'brown')
            ),
            $allBoxes->that(AreLighter::than(100)->and($areNotTooLarge))
        );
    }

    /**
     * @test
     * @dataProvider warehouseFullOfBoxes
     */
    function specifications_can_be_composed_inline(
        CollectionOfBoxes $allBoxes
    ) {
        $areWide = AreWider::than(10);
        $areHigh = AreHigher::than(10);
        $areLong = AreLonger::than(10);
        $haveIrregularSize = $areWide->or($areHigh)->or($areLong);
        $areHeavy = AreHeavier::than(60);

        $areDueForHeavyTransport = $haveIrregularSize->and($areHeavy);

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofSizeAndWeight(2,  4,  12, 75,  'black'),
                Box::ofSizeAndWeight(9,  11, 6,  110, 'blue')
            ),
            $allBoxes->that($areDueForHeavyTransport)
        );
    }

    /**
     * @test
     * @dataProvider warehouseFullOfBoxes
     */
    function specifications_can_be_composed_in_classes(
        CollectionOfBoxes $allBoxes
    ) {
        $areHeavy = AreHeavier::than(60);
        $haveIrregularSize = new class(10) extends Specification {
            private $condition;

            public function __construct(int $theSize)
            {
                $this->condition = AreWider::than($theSize)
                    ->or(AreHigher::than($theSize))
                    ->or(AreLonger::than($theSize));
            }

            public function isSatisfiedBy($object) : bool
            {
                return $this->condition->isSatisfiedBy($object);
            }
        };

        $areDueForHeavyTransport = $areHeavy->and($haveIrregularSize);

        $this->assertEquals(
            CollectionOfBoxes::containing(
                Box::ofSizeAndWeight(2,  4,  12, 75,  'black'),
                Box::ofSizeAndWeight(9,  11, 6,  110, 'blue')
            ),
            $allBoxes->that($areDueForHeavyTransport)
        );
    }

    public function warehouseFullOfBoxes()
    {
        return [
            'Some boxes' => [
                CollectionOfBoxes::containing(
                    Box::ofSizeAndWeight(2,  4,  12, 75,  'black'),
                    Box::ofSizeAndWeight(9,  11, 6,  110, 'blue'),
                    Box::ofSizeAndWeight(5,  7,  8,  90,  'white'),
                    Box::ofSizeAndWeight(3,  2,  5,  40,  'brown'),
                    Box::ofSizeAndWeight(2,  2,  2,  999, 'gold'),
                    Box::ofSizeAndWeight(20, 11, 10, 60,  'brown')
                )
            ]
        ];
    }
}
