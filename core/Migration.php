<?php

namespace Core;

class Migration
{
    private $db;
    private $table;
    private $columns = [];

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createTable($table, $callback)
    {
        $this->table = $table;
        $callback($this);
        $this->execute();
    }

    public function id()
    {
        $this->columns[] = "id INT AUTO_INCREMENT PRIMARY KEY";
        return $this;
    }

    public function string($name)
    {
        $this->columns[] = "$name VARCHAR(255) NOT NULL";
        return $this;
    }

    public function timestamps()
    {
        $this->columns[] = "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        $this->columns[] = "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        return $this;
    }

    private function execute()
    {
        $columns = implode(", ", $this->columns);
        $query = "CREATE TABLE {$this->table} ($columns) ENGINE=INNODB;";
        $this->db->exec($query);
    }
}
