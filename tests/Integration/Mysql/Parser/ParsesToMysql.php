<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Integration\Mysql\Parser;

interface ParsesToMysql
{
    public function toSql() : string;
}
