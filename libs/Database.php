<?php

class Database extends PDO {
    function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
    }

    /**
     * @param string $sql
     * @param array $array
     * @param int $fetchMode
     * @return array
     */
    function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

    /**
     * insert
     * @param string $table A name the table to insert into
     * @param string $data An associative array
     * @param string $where the where query part
     */
    function insert($table, $data, $where = null) {

        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        if ($where == null) {
            $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
        } else {
            $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)  WHERE $where");
        }

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
    }

    /**
     * insert
     * @param string $table A name the table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    function update($table, $data, $where) {
        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key` = :$key, ";
        }
        $fieldDetails = rtrim($fieldDetails, ', ');

        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
    }
}