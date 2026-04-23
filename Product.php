<?php
class Product {
    private $conn;
    private $table_name = "products";

    // При створенні об'єкта класу, ми передаємо йому з'єднання з базою
    public function __construct($db) {
        $this->conn = $db;
    }

    // Метод для отримання всіх товарів (це наша літера R у CRUD)
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>