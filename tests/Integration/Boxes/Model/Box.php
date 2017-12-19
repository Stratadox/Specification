<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Boxes\Model;

class Box
{
    private $width;
    private $height;
    private $length;
    private $weight;
    private $colour;

    public function __construct(
        int $width = 1,
        int $height = 1,
        int $length = 1,
        int $weight = 1,
        string $colour = 'brown'
    ) {
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
        $this->weight = $weight;
        $this->colour = $colour;
    }

    public static function ofSize(
        int $width,
        int $height,
        int $length,
        string $colour = 'brown'
    ) : Box
    {
        return new static($width, $height, $length, 1, $colour);
    }

    public static function ofSizeAndWeight(
        int $width,
        int $height,
        int $length,
        int $weight,
        string $colour = 'brown'
    ) : Box
    {
        return new static($width, $height, $length, $weight, $colour);
    }

    public static function ofLength(int $length) : Box
    {
        return new static(1, 1, $length);
    }

    public static function ofWeight(int $weight) : Box
    {
        return new static(1, 1, 1, $weight);
    }

    public static function ofColour(string $colour) : Box
    {
        return new static(1, 1, 1, 1, $colour);
    }

    public static function ofColourAndWeight(string $colour, int $weight) : Box
    {
        return new static(1, 1, 1, $weight, $colour);
    }

    public function width() : int
    {
        return $this->width;
    }

    public function height() : int
    {
        return $this->height;
    }

    public function length() : int
    {
        return $this->length;
    }

    public function weight() : int
    {
        return $this->weight;
    }

    public function colour() : string
    {
        return $this->colour;
    }
}
