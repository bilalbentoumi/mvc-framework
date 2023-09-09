<?php

namespace mvc\framework\core;

use mvc\framework\database\Database;
use mvc\framework\helpers\InputFilter;

class Model {

    use InputFilter;

    const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;
    const DATA_TYPE_STR = \PDO::PARAM_STR;
    const DATA_TYPE_INT = \PDO::PARAM_INT;
    const DATA_TYPE_DECIMAL = 4;
    const DATA_TYPE_DATE = 5;

    private function buildParamsSQL() {
        $params = '';
        foreach(static::$tableSchema as $ColumnName => $type) {
            $params .= $ColumnName . ' = :' . $ColumnName . ', ';
        }
        return $params = trim($params, ', ');
    }

    private function bindParamsValues(\PDOStatement &$stmt) {
        foreach (static::$tableSchema as $ColumnName => $type) {
            if ($type == 4) {
                $filtredValue = self::filterFLoat($this->$ColumnName);
                $stmt->bindValue(":{$ColumnName}", $filtredValue);
            } else {
                $stmt->bindValue(":{$ColumnName}", $this->$ColumnName, $type);
            }
        }
    }

    private function create() {
        $conn = Database::Connect();
        $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . self::buildParamsSQL();
        $stmt = $conn->prepare($sql);
        $this->bindParamsValues($stmt);
        if($stmt->execute()) {
            $this->{static::$primaryKey} = $conn->lastInsertId();
            return true;
        }
        return false;
    }

    private function update() {
        $conn = Database::Connect();
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . self::buildParamsSQL() . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = $conn->prepare($sql);
        $this->bindParamsValues($stmt);
        return $stmt->execute();
    }

    public function save() {
        return $this->{static::$primaryKey} == null ? $this->create() : $this->update();
    }

    public function delete() {
        $conn = Database::Connect();
        $sql = 'DELETE FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    public static function getAll() {
        $conn = Database::Connect();
        $sql = 'SELECT * FROM ' . static::$tableName;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        return (is_array($results) && !empty($results)) ? $results : false ;
    }

    public static function getByPrimaryKey($primaryKey) {
        $conn = Database::Connect();
        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . ' = ' . $primaryKey;
        $stmt =$conn->prepare($sql);
        $stmt->execute();
        $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        return $obj != NULL ? array_shift($obj) : false ;
    }

    public static function get($sql, $options = array()) {
        $conn = Database::Connect();
        $stmt = $conn->prepare($sql);
        if (!empty($options)) {
            foreach ($options as $ColumnName => $value) {
                if ($value[0] == 4) {
                    $filtredValue = self::filterFLoat($value[1]);
                    $stmt->bindValue(":{$ColumnName}", $filtredValue);
                } else {
                    $stmt->bindValue(":{$ColumnName}", $value[1], $value[0]);
                }
            }
        }
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        return (is_array($results) && !empty($results)) ? new \ArrayIterator($results) : false ;
    }

    public static function getBy($columns) {
        $conn = Database::Connect();
        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ';

        foreach($columns as $ColumnName => $value) {
            $sql .= $ColumnName . ' = \'' . $value . '\' AND ';
        }
        $sql = trim($sql, ' AND ');

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        return (is_array($results) && !empty($results)) ? new \ArrayIterator($results) : false ;
    }

}