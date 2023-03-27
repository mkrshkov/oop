<?php

class Entity {
    protected $table_name;
    protected $pdo;

    public function __construct($table_name) {
        $db = DatabaseController::getInstance();
        $this->pdo = $db->getPdo();
        $this->table_name = $table_name;
    }

    public function getAll() {
        $sql = "SELECT * FROM {$this->table_name}";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table_name} ({$fields}) VALUES ({$placeholders})";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);

        return $this->pdo->lastInsertId();
    }

    public function update($id,$id_type,$data) {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "{$key} = :{$key}, ";
        }
        $set = rtrim($set, ", ");

        $sql = "UPDATE {$this->table_name} SET {$set} WHERE $id_type = :id";
        $data['id'] = $id;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);

        return $stmt->rowCount();
    }

    public function delete($conditions) {
        $where = "";
        foreach ($conditions as $key => $value) {
            $where .= "{$key} = :{$key} AND ";
        }
        $where = rtrim($where, " AND ");

        $sql = "DELETE FROM {$this->table_name} WHERE {$where}";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);

        return $stmt->rowCount();
    }

}
