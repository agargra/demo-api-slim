<?php
namespace App\Repository;

use \Doctrine\DBAL\Connection;
use \Doctrine\DBAL\Query\QueryBuilder;

abstract class BaseRepository
{
    protected Connection $database;
    protected QueryBuilder $builder;

    public function __construct(Connection $database)
    {
        $this->database = $database;
        $this->builder = $database->createQueryBuilder();
    }

    protected function getDb(): Connection
    {
        return $this->database;
    }

}