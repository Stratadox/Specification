<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Usage\Mysql\Parser;

use ReflectionClass;
use Stratadox\Specification\Binary\BinarySpecification;
use Stratadox\Specification\Contract\Satisfiable;
use Stratadox\Specification\Test\Usage\Mysql\Specification\HaveType;
use Stratadox\Specification\Unary\UnarySpecification;

/**
 * Very imperfect mysql parser, made for the sole purpose of demonstrating how
 * the specification classes could be used for other purposes than filtering
 * in-memory collections.
 *
 * The parser itself works as follows:
 * - First ask the condition can convert itself to mysql (which is true for the
 *   specification classes `AreRated` and `AreCheaperThan`) in which case their
 *   output is used.
 * - If the specification does not implement our interface, but adheres to its
 *   own boundaries (like good classes probably should), we get its unqualified
 *   (short) class name, put on a prefix and try and execute that as a method.
 * - If all the above fails, throw an exception.
 * Composite conditions will repeat the above for each condition they contain.
 *
 * TL;DR: Poor man's method overloading. Some recursion.
 *
 *
 * WARNING: When using something like this in any kind of production environment,
 * please don't put the parameter values directly in the sql like these classes
 * do. The only reason this is not vulnerable to sql injections is because I
 * went out of my way to make the domain consist of integer values only. In real
 * life, you will most likely not have this opportunity.
 *
 * TL;DR: Do as I say, not as I do.
 */
class MysqlParser
{
    public function whereClauseFor(Satisfiable $condition) : string
    {
        return sprintf('WHERE %s', $this->parseSqlFor($condition));
    }

    protected function parseSqlFor(Satisfiable $condition) : string
    {
        if ($condition instanceof ParsesToMysql) {
            return $condition->toSql();
        }

        $class = (new ReflectionClass($condition))->getShortName();
        if (is_callable([$this, "parseSqlFor$class"])) {
            return $this->{"parseSqlFor$class"}($condition);
        }

        throw CannotParseSpecification::noImplementationFor($condition);
    }

    protected function parseSqlForAndSpecification(
        BinarySpecification $specification
    ) : string
    {
        return sprintf('(%s) AND (%s)',
            $this->parseSqlFor($specification->leftHandCondition()),
            $this->parseSqlFor($specification->rightHandCondition())
        );
    }

    protected function parseSqlForOrSpecification(
        BinarySpecification $specification
    ) : string
    {
        return sprintf('(%s) OR (%s)',
            $this->parseSqlFor($specification->leftHandCondition()),
            $this->parseSqlFor($specification->rightHandCondition())
        );
    }

    protected function parseSqlForNotSpecification(
        UnarySpecification $specification
    ) : string
    {
        return sprintf('NOT (%s)',
            $this->parseSqlFor($specification->condition())
        );
    }

    protected function parseSqlForHaveType(
        HaveType $specification
    ) : string
    {
        return sprintf('product.type = %d', $specification->type());
    }
}
