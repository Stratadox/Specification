<?php

declare(strict_types = 1);

namespace Stratadox\Specification\Test\Usage\Mysql\Parser;

interface ParsesToMysql
{
    public function toSql() : string;
}
