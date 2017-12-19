<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Usage\Mysql\Model;

use Closure;
use Stratadox\Specification\Contract\Satisfiable;

class Products
{
    private $products;

    public function __construct(Product ...$products)
    {
        $this->products = $products;
    }

    public static function containing(Product ...$products) : Products
    {
        return new static(...$products);
    }

    public function thatAre(Satisfiable $condition) : Products
    {
        return $this->filter(function (Product $object) use ($condition) {
            return $condition->isSatisfiedBy($object);
        });
    }

    public function thatAreNot(Satisfiable $condition) : Products
    {
        return $this->filter(function (Product $object) use ($condition) {
            return !$condition->isSatisfiedBy($object);
        });
    }

    private function filter(Closure $callback) : Products
    {
        return new static(...array_filter($this->products, $callback));
    }
}
