<?php


/**
 *
 */
abstract class Model
{
    /**
     * @var string $table_name
     */
    private string $table_name;
    /**
     * @var object $dbh
     */
    private object $dbh;

    /**
     * @param int $id
     * @return array
     */
    abstract public function fetch(int $id): array;

    /**
     * @param int $limit
     * @param string $order
     * @return array
     */
    abstract public function fetch_all(int $limit, string $order): array;

    /**
     * @param int $id
     * @return array
     */
    abstract public function delete(int $id): array;
}