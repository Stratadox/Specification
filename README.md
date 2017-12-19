# Specification 

[![Build Status](https://travis-ci.org/Stratadox/Specification.svg?branch=master)](https://travis-ci.org/Stratadox/Specification)
[![Coverage Status](https://coveralls.io/repos/github/Stratadox/Specification/badge.svg?branch=master)](https://coveralls.io/github/Stratadox/Specification?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Stratadox/Specification/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Stratadox/Specification/?branch=master)

An implementation of the Specification pattern for Php7

## Installation

Install using composer:

```
composer require stratadox/specification
```


## Usage Sample

```php
// The business logic
$allBoxes = CollectionOfBoxes::containing(
    Box::ofWeight(1),
    Box::ofWeight(2),
    Box::ofWeight(3),
    Box::ofWeight(5),
    Box::ofWeight(12),
    Box::ofWeight(26)
);
$weighBetween2and10 = AreHeavier::than(2)->and(AreLighter::than(10));
$this->assertEquals(
    CollectionOfBoxes::containing(
        Box::ofWeight(3),
        Box::ofWeight(5),
        Box::ofWeight(26)
    ),
    $allBoxes->that($weighBetween2and10->or(AreHeavier::than(20)))
);
```