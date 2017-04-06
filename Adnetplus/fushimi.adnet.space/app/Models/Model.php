<?php

namespace App\Models;

use \PDO;
use \PDOException;

class Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The query for the model.
     *
     * @var string
     */
    protected $query;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        try {
            $dsn = sprintf('mysql:dbname=%s;host=%s;port=%s;charset=utf8', DB_NAME, DB_HOST, DB_PORT);
            $this->connection = new PDO($dsn, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            die("Error!: " . $e->getMessage() . "<br/>");
        }
    }

    /**
     * @return mixed
     */
    public static function all()
    {
        return (new static())->newAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function find($id)
    {
        return (new static())->newFind($id);
    }

    /**
     * Update data
     *
     * @param array $data
     */
    public static function create(array $data)
    {
        return (new static())->newCreate($data);
    }

    /**
     * @param array $data
     */
    public static function update($id, array $data)
    {
        return (new static())->newUpdate($id, $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function delete($id)
    {
        return (new static())->newDelete($id);
    }

    /**
     * @param array $where
     * @param bool $many
     * @return mixed
     */
    public static function whereEquals(array $where, $many = true)
    {
        return (new static())->newWhereEquals($where, $many);
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function query($query)
    {
        return (new static())->getObjectList($query);
    }

    /**
     * @param null $conditions
     * @return mixed
     */
    public static function countAll($conditions = null)
    {
        return (new static())->newCountAll($conditions);
    }

    /**
     * @return array
     */
    public function newAll()
    {
        $sql = "SELECT id, name_ja AS name FROM $this->table";
        return $this->getObjectList($sql);
    }

    /**
     * @param $where
     * @param bool $many
     * @return array|mixed
     */
    public function newWhereEquals($where, $many = true)
    {
        $arr = [];
        foreach ($where as $key => $value) {
            $arr[] = "$key = '$value'";
        }
        $str = implode(' AND ', $arr);
        $query = "SELECT * FROM {$this->table} WHERE " . $str;
        if ($many) {
            return $this->getObjectList($query);
        } else {
            return $this->getOneObject($query);
        }
    }

    /**
     * @param $searchConditions
     * @return string
     */
    public function newCountAll($searchConditions)
    {
        $sql = "SELECT COUNT(*) AS num_rec FROM {$this->table}";
        if ($searchConditions) {
            $sql .= " WHERE {$searchConditions}";
        }
        return $this->getOneValue($sql);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function newFind($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return $this->getOneObject($sql, [$id]);
    }

    /**
     * @param $id
     * @return bool
     */
    public function newDelete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $this->query = $this->connection->prepare($sql);
        return $this->query->execute([$id]);
    }

    /**
     * Insert a new record into table
     *
     * @param array $data [column-name => column-value]
     */
    public function newCreate(array $data)
    {
        $sql = "INSERT INTO ".$this->table." (";
        $sql .= implode(", ", array_keys($data)) . ") VALUES(";
        $sql .= "'" . implode("', '", array_values($data)) . "')";
        $this->query = $this->connection->prepare($sql);
        $this->query->execute();
        return $this->connection->lastInsertId('id');
    }

    /**
     * @param array $data
     */
    public function newUpdate($id, array $data)
    {
        $sql = "UPDATE $this->table SET ";
        $colValues = array_values($data);
        $colValues[] = $id;
        foreach (array_keys($data) as $colName) {
            $sql .= "$colName = ?,";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= " WHERE $this->primaryKey = ?";
        $this->query = $this->connection->prepare($sql);
        return $this->query->execute($colValues);
    }

    /**
     * @param $sql
     * @return string
     */
    private function getOneValue($sql)
    {
        $this->query = $this->connection->prepare($sql);
        $this->query->execute();
        return $this->query->fetchColumn();
    }

    /**
     * @param $sql
     * @param array $paramValues
     * @return mixed
     */
    private function getOneObject($sql, array $paramValues = array())
    {
        $this->query = $this->connection->prepare($sql);
        if ($paramValues) {
            $this->query->execute($paramValues);
        } else {
            $this->query->execute();
        }
        return $this->query->fetchObject();
    }

    /**
     * @param $sql
     * @return array
     */
    private function getObjectList($sql)
    {
        $this->query = $this->connection->prepare($sql);
        $this->query->execute();
        return $this->query->fetchAll(PDO::FETCH_OBJ);
    }
}