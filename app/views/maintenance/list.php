<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mantenimientos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #28a745;
            color: white;
        }

        .btn-edit {
            background-color: #dc3545; 
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .btn-edit:hover {
            background-color: #c82333; 
        }

        .btn-back {
            display: block; 
            width: 200px; 
            background-color: #007bff; 
            color: white;
            border: none;
            padding: 10px; 
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center; 
            margin: 20px auto; 
        }

        .btn-back:hover {
            background-color: #0056b3; 
        }

        .alert {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid transparent;
            border-radius: 5px;
            text-align: center;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Listado de Mantenimientos</h1>

        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert <?php echo strpos($_SESSION['message'], 'Error') === false ? 'alert-success' : 'alert-error'; ?>">
                <?php
                echo htmlspecialchars($_SESSION['message']);
                unset($_SESSION['message']); 
                ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Detalle</th>
                    <th>Monto de Pago</th>
                    <th>Vehículo</th>
                    <th>Placa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($maintenances as $maintenance): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($maintenance['id']); ?></td>
                        <td><?php echo htmlspecialchars($maintenance['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($maintenance['detalle']); ?></td>
                        <td><?php echo htmlspecialchars($maintenance['monto_pago']); ?></td>
                        <td><?php echo htmlspecialchars($maintenance['nombre_vehiculo']); ?></td>
                        <td><?php echo htmlspecialchars($maintenance['placa_vehiculo']); ?></td>
                        <td>
                            <a href="?action=edit&id=<?php echo htmlspecialchars($maintenance['id']); ?>" class="btn-edit">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../public/index.php" class="btn-back">Regresar</a> 
    </div>
</body>
</html>
