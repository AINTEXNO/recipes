<?php

namespace app\classes;

use PDO;
use PDOException;

include_once($_SERVER['DOCUMENT_ROOT'] . '/app/helpers/helpers.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/interfaces/crudInterface.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/config.php');

class Database implements crudInterface
{
    /**
     * Database instance
     * @var PDO
     */

    private $database;

    /**
     * Database table name
     * @var string
     */

    private $table;

    /**
     * Database constructor
     * @param $table
     */

    public function __construct($table)
    {
        $dsn = DB_DRIVER . ':dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8';

        try {
        $this->database = new PDO($dsn, DB_USER, DB_PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(PDOException $exception) {
            exit("Database connection error. " . $exception);
        }

        $this->table = $table;
    }

    /**
     * @param string $query
     * @param array $variables
     * @return object
     */

    public function query(string $query, array $variables = [])
    {
        $sth = $this->database->prepare($query);
        $sth->execute($variables);

        return (object)$sth;
    }

    /**
     * @param array $data
     * @return object
     * $db->insert('name' => 'Name', 'login' => '12345');
     */

    public function insert(array $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);

        $queryColumns = '(' . implode(', ', $keys) . ')';
        $queryValues = '(' . mb_substr(str_repeat('?,', count($values)), 0, -1) . ')';

        $query = "INSERT INTO `$this->table` $queryColumns VALUES $queryValues";

        return $this->query($query, $values);
    }

    /**
     * @return string
     */

    public function lastInsertId(): string
    {
        return $this->database->lastInsertId();
    }

    /**
     * @param string $sql
     * @param array $variables
     * @param string $select
     * @return object
     * $db->select('WHERE id=?', array($id))
     */

    public function select(string $sql = "", array $variables = [], string $select = null)
    {
        $select = $select ?? '*';
        $query = "SELECT " . $select . " FROM $this->table $sql";

        return $this->query($query, $variables);
    }

    /**
     * @param array $data
     * @param string $param
     * @return bool
     * $db->update(array('name' => $name, 'surname' => $surname, 'id' => $id), 'id')
     */

    public function update(array $data, string $param): bool
    {
        $whereParam = $data[$param];
        unset($data[$param]);

        $keys = array_keys($data);
        $values = array_values($data);

        $set = implode('=?, ', $keys) . '=?';
        $query = "UPDATE $this->table SET $set WHERE $param = ?";

        array_push($values, $whereParam);

        $result = $this->query($query, $values)->rowCount();

        return (bool)$result;
    }

    /**
     * @param string $sql
     * @param array $variables
     * @return bool
     * $db->delete('WHERE id=?', array($id));
     */

    public function delete(string $sql, array $variables): bool
    {
        $query = "DELETE FROM $this->table $sql";

        $result = $this->query($query, $variables)->rowCount();

        return (bool)$result;
    }

}