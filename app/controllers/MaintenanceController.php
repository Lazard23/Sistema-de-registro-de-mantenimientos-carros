<?php
require_once '../config/database.php';
require_once '../app/models/Vehicle.php';
require_once '../app/models/Maintenance.php';

class MaintenanceController {
    private $db;
    private $vehicle;
    private $maintenance;

    public function __construct() {
        session_start(); // Iniciar sesión
        $database = new Database();
        $this->db = $database->getConnection();
        $this->vehicle = new Vehicle($this->db);
        $this->maintenance = new Maintenance($this->db);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir datos del formulario
            $this->maintenance->fecha = $_POST['fecha'];
            $this->maintenance->detalle = $_POST['detalle'];
            $this->maintenance->monto_pago = $_POST['monto_pago'];
            $this->maintenance->id_vehiculo = $_POST['vehiculo'];

            // Verifica si el vehículo existe
            if ($this->vehicleExists($this->maintenance->id_vehiculo)) {
                if ($this->maintenance->create()) {
                    echo json_encode(['status' => 'success', 'message' => 'Mantenimiento registrado correctamente.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al registrar el mantenimiento.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'El vehículo seleccionado no existe.']);
            }
            exit(); 
        }
    }

    // Método para listar mantenimientos
    public function list() {
        $maintenances = $this->maintenance->read(); // Llama al método read() del modelo Maintenance
        include_once '../app/views/maintenance/list.php'; // Incluye la vista de listado de mantenimientos
    }

    // Método para cargar los datos del mantenimiento específico
    public function edit($id) {
        $this->maintenance->id = $id; 
        $maintenanceData = $this->maintenance->readOne(); 

        if ($maintenanceData) {
            $vehicles = $this->getVehicles(); // Obtiene todos los vehículos
            include_once '../app/views/maintenance/edit.php'; 
        } else {
            // Maneja el caso en que el mantenimiento no se encuentre
            $_SESSION['message'] = 'Mantenimiento no encontrado.';
            header("Location: ../public/index.php?action=list"); // Redirige a la lista si no se encuentra el mantenimiento
            exit();
        }
    }

    // Método para actualizar el mantenimiento
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibe los datos del formulario
            $this->maintenance->id = $_POST['id'];
            $this->maintenance->fecha = $_POST['fecha'];
            $this->maintenance->detalle = $_POST['detalle'];
            $this->maintenance->monto_pago = $_POST['monto_pago'];
            $this->maintenance->id_vehiculo = $_POST['vehiculo'];

            // Verifica si el vehículo existe
            if ($this->vehicleExists($this->maintenance->id_vehiculo)) {
                if ($this->maintenance->update()) {
                    echo json_encode(['status' => 'success', 'message' => 'Mantenimiento actualizado correctamente.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el mantenimiento.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'El vehículo seleccionado no existe.']);
            }
            exit(); 
        }
    }

    // Verifica si el vehículo existe en la base de datos
    private function vehicleExists($vehicleId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM vehiculos WHERE id = :id");
        $stmt->bindParam(':id', $vehicleId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Obtiene la lista de vehículos
    public function getVehicles() {
        return $this->vehicle->read();
    }
}

// Manejo de la solicitud
$controller = new MaintenanceController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        $controller->update(); 
    } else {
        $controller->create(); 
    }
} else {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'list') {
            $controller->list(); // Llama al método para listar mantenimientos
        } elseif ($_GET['action'] == 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']); // Llama al método para editar el mantenimiento
        } else {
            $vehicles = $controller->getVehicles(); // Obtiene los vehículos
            include_once '../app/views/maintenance/create.php'; 
        }
    } else {
        $vehicles = $controller->getVehicles(); // Obtiene los vehículos
        include_once '../app/views/maintenance/create.php'; 
    }
}
