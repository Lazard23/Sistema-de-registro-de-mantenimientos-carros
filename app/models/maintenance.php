<?php
class Maintenance {
    private $conn;
    private $table_name = "mantenimiento"; 

    public $id;
    public $fecha;
    public $detalle;
    public $monto_pago;
    public $id_vehiculo;

    public function __construct($db) {
        $this->conn = $db; // Establece la conexión a la base de datos
    }

    public function create() {
        // Insertar un nuevo registro
        $query = "INSERT INTO " . $this->table_name . " SET fecha=:fecha, detalle=:detalle, monto_pago=:monto_pago, id_vehiculo=:id_vehiculo";
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos 
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->detalle = htmlspecialchars(strip_tags($this->detalle));
        $this->monto_pago = htmlspecialchars(strip_tags($this->monto_pago));
        $this->id_vehiculo = htmlspecialchars(strip_tags($this->id_vehiculo));

        
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":detalle", $this->detalle);
        $stmt->bindParam(":monto_pago", $this->monto_pago);
        $stmt->bindParam(":id_vehiculo", $this->id_vehiculo);

        // Ejecución de la consulta
        if ($stmt->execute()) {
            return true; 
        }
        return false; 
    }

    // Método para leer todos los mantenimientos
    public function read() {
        
        $query = "SELECT m.*, v.nombre AS nombre_vehiculo, v.placa AS placa_vehiculo
                  FROM " . $this->table_name . " m 
                  JOIN vehiculos v ON m.id_vehiculo = v.id"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Método para actualizar mantenimientos
    public function update() {
        // Actualizar un registro existente
        $query = "UPDATE " . $this->table_name . " SET fecha=:fecha, detalle=:detalle, monto_pago=:monto_pago, id_vehiculo=:id_vehiculo WHERE id=:id";
        $stmt = $this->conn->prepare($query);

         
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->detalle = htmlspecialchars(strip_tags($this->detalle));
        $this->monto_pago = htmlspecialchars(strip_tags($this->monto_pago));
        $this->id_vehiculo = htmlspecialchars(strip_tags($this->id_vehiculo));
        $this->id = htmlspecialchars(strip_tags($this->id)); // Agregar el ID

        
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":detalle", $this->detalle);
        $stmt->bindParam(":monto_pago", $this->monto_pago);
        $stmt->bindParam(":id_vehiculo", $this->id_vehiculo);
        $stmt->bindParam(":id", $this->id); // Vincular ID

        // Ejecución de la consulta
        if ($stmt->execute()) {
            return true; 
        }
        return false; 
    }

    // Método para leer un mantenimiento 
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
}
?>
