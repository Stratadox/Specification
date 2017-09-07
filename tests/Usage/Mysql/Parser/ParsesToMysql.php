<?php

namespace Stratadox\Specification\Test\Usage\Mysql\Parser;

interface ParsesToMysql
{
    public function toSql() : string;
}
