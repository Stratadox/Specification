<?php

namespace Stratadox\Specification\Test\Usage\Boxes\Model;

use Stratadox\Specification\Contract\Satisfiable;

class CollectionOfBoxes
{
    private $boxes;

    public function __construct(Box ...$boxes)
    {
        $this->boxes = $boxes;
    }

    public static function containing(Box ...$boxes) : CollectionOfBoxes
    {
        return new static(...$boxes);
    }

    public function that(Satisfiable $condition) : CollectionOfBoxes
    {
        return new CollectionOfBoxes(...array_filter(
            $this->boxes, [$condition, 'isSatisfiedBy']
        ));
    }
}
