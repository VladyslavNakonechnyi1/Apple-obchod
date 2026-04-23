<?php
// Вимога ООП: Використовуємо класи
class Database {
    private $host = "127.0.0.1";
    private $db_name = "apple_db";
    private $username = "root";
    private $password = "";
    public $conn;

    // Метод для створення з'єднання
    public function getConnection() {
        $this->conn = null;

        try {
            // Використовуємо PDO (вимога PHP 8+)
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Налаштовуємо режим помилок, щоб бачити їх, якщо щось піде не так
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Помилка підключення: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>