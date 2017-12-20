<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Mysql;

use PHPUnit\Framework\TestCase;
use Stratadox\Specification\Test\Integration\Mysql\Parser\CannotParseSpecification;
use Stratadox\Specification\Test\Integration\Mysql\Parser\MysqlParser;
use Stratadox\Specification\Test\Integration\Mysql\Specification\AreCheaperThan;
use Stratadox\Specification\Test\Integration\Mysql\Specification\AreRated;
use Stratadox\Specification\Test\Integration\Mysql\Specification\HaveType;

/**
 * @coversNothing
 */
class QueryParsingTest extends TestCase
{
    /** @test */
    function AndSpecification_parses_to_mysql()
    {
        $specification = AreCheaperThan::price(16)->and(HaveType::number(1));
        $parser = new MysqlParser();

        $this->assertEquals(
            'WHERE (product.price < 16) AND (product.type = 1)',
            $parser->whereClauseFor($specification)
        );
    }

    /** @test */
    function NotSpecification_parses_to_mysql()
    {
        $specification = HaveType::number(2)->not();
        $parser = new MysqlParser();

        $this->assertEquals(
            'WHERE NOT (product.type = 2)',
            $parser->whereClauseFor($specification)
        );
    }

    /** @test */
    function OrSpecification_with_nested_AndSpecification_parses_to_mysql()
    {
        $specification = AreCheaperThan::price(25)->and(HaveType::number(2))->or(AreRated::as(10));
        $parser = new MysqlParser();

        $this->assertEquals(
            'WHERE ((product.price < 25) AND (product.type = 2)) OR (product.rating = 10)',
            $parser->whereClauseFor($specification)
        );
    }

    /** @test */
    function XorSpecification_throws_exception_because_it_is_not_implemented_in_the_parser()
    {
        $specification = HaveType::number(2)->xor(AreRated::as(5));
        $parser = new MysqlParser();

        $this->expectException(CannotParseSpecification::class);
        $parser->whereClauseFor($specification);
    }
}
