<?php

class Connection extends PDO
{
    public function __construct($dsn = "mysql:host=127.0.0.1;dbname=schoolApp",  $username = "root", $password = "root", $options = [])
    {
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_replace($default_options, $options);
        parent::__construct($dsn, $username, $password, $options);
    }

    public function run($sql, $args = NULL)
    {
        if (!$args) {
            return $this->query($sql);
        }

        $stmt = $this->prepare($sql);
        $stmt->execute($args);

        return $stmt;
    }

    public function pdoMultiInsert($tableName, $data)
    {
        $rowsSQL = [];
        $toBind = [];

        $columnNames = array_keys($data[0]);

        foreach ($data as $arrayIndex => $row) {
            $params = array();
            foreach ($row as $columnName => $columnValue) {
                $param = ":" . $columnName . $arrayIndex;
                $params[] = $param;
                $toBind[$param] = $columnValue;
            }
            $rowsSQL[] = "(" . implode(", ", $params) . ")";
        }

        $sql = "INSERT INTO `$tableName` (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $rowsSQL);
        $stmt = $this->prepare($sql);

        foreach ($toBind as $param => $val) {
            $stmt->bindValue($param, $val);
        }

        return $stmt->execute();
    }
}
