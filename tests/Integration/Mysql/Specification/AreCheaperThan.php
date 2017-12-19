<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Mysql\Specification;

use Stratadox\Specification\Contract\Specifies;
use Stratadox\Specification\Specification;
use Stratadox\Specification\Test\Integration\Mysql\Model\Product;
use Stratadox\Specification\Test\Integration\Mysql\Parser\ParsesToMysql;

class AreCheaperThan extends Specification implements ParsesToMysql
{
    private $price;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public static function price(int $price) : Specifies
    {
        return new static($price);
    }

    public function isSatisfiedBy($object) : bool
    {
        return $object instanceof Product
            && $object->price() === $this->price;
    }

    public function toSql() : string
    {
        return sprintf('product.price < %d', $this->price);
    }
}
