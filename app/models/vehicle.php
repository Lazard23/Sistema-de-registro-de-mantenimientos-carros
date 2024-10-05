<?php
class Vehicle {
    private $conn;
    private $table_name = "vehiculos";

    public $id;
    public $nombre;
    public $marca;
    public $modelo;
    public $año;
    public $placa;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT id, nombre, placa FROM " . $this->table_name; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
