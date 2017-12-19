<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Usage\Mysql\Specification;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Specification;
use Stratadox\Specification\Test\Usage\Mysql\Model\Product;
use Stratadox\Specification\Test\Usage\Mysql\Parser\ParsesToMysql;

class AreRated extends Specification implements ParsesToMysql
{
    private $rating;

    public function __construct(int $rating)
    {
        $this->rating = $rating;
    }

    public static function as(int $rating) : Specifies
    {
        return new static($rating);
    }

    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Product
            && $object->rating() === $this->rating;
    }

    public function toSql() : string
    {
        return sprintf('product.rating = %d', $this->rating);
    }
}
