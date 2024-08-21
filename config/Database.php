<?php
class Database extends PDO {
    private $pdo;
    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // Select a single record by id
    public function selectOne($table, $column, $value) {
        $sql = "SELECT * FROM $table WHERE $column = :value";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Update function
    public function update($table, $data, $where) {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $fields = implode(", ", $fields);

        $whereCondition = [];
        foreach ($where as $key => $value) {
            $whereCondition[] = "$key = :$key";
        }
        $whereCondition = implode(" AND ", $whereCondition);

        $sql = "UPDATE $table SET $fields WHERE $whereCondition";
        $stmt = $this->pdo->prepare($sql);

        foreach (array_merge($data, $where) as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }

        return $stmt->execute();
    }

    // Run any custom query
    public function basicRun($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}