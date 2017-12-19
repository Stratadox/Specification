<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Usage\Mysql\Model;

class Product
{
    private $rating;
    private $type;
    private $price;

    public function __construct(int $rating, int $type, int $price)
    {
        $this->rating = $rating;
        $this->type = $type;
        $this->price = $price;
    }

    public function rating() : int
    {
        return $this->rating;
    }

    public function type() : int
    {
        return $this->type;
    }

    public function price() : int
    {
        return $this->price;
    }
}
