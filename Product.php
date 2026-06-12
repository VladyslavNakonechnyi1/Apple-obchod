<?php
class Product {
    private $conn;
    private $table_name = "products";
    
    //Spojenie s databazou
    public function __construct($db) {
        $this->conn = $db;
    }

    // READ zobrazenie vsetkych produktov
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // CREATE pridanie noveho produktu
    public function create($name, $description, $price, $image = 'default.png') {
        $query = "INSERT INTO " . $this->table_name . " (name, description, price, image) VALUES (:name, :description, :price, :image)";
        $stmt = $this->conn->prepare($query);
    // Vrati html-kod na bezbecni symbol
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
    // Priradenie hodnot proti sql injection
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":image", $image);

        if($stmt->execute()) { return true; }
        return false;
    }

    // UPDATE uprava existujuceho produktu
    public function update($id, $price, $description) {
        $query = "UPDATE " . $this->table_name . " SET price = :price, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $price = htmlspecialchars(strip_tags($price));
        $description = htmlspecialchars(strip_tags($description));
        $id = htmlspecialchars(strip_tags($id));
    // Priradenie novych dat
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":id", $id);

        if($stmt->execute()) { return true; }
        return false;
    }

    // DELETE
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $id = htmlspecialchars(strip_tags($id)); 
        $stmt->bindParam(":id", $id);

        if($stmt->execute()) { return true; }
        return false;
    }
}
?>