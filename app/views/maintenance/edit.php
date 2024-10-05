<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Mantenimiento</title>
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
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #dc3545; 
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
        }

        button:hover {
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
            display: none;
            padding: 15px;
            background-color: #28a745;
            color: white;
            margin-bottom: 15px;
            border-radius: 5px;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            transition: opacity 0.5s;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modificar Registro de Mantenimiento</h1>
        <form id="maintenanceForm" action="" method="POST">
            <input type="hidden" name="action" value="update"> 
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($maintenanceData['id']); ?>">
            
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($maintenanceData['fecha']); ?>" required>

            <label for="detalle">Detalle de Mantenimiento:</label>
            <input type="text" name="detalle" id="detalle" value="<?php echo htmlspecialchars($maintenanceData['detalle']); ?>" required>

            <label for="monto_pago">Monto de Pago:</label>
            <input type="number" name="monto_pago" id="monto_pago" step="0.01" value="<?php echo htmlspecialchars($maintenanceData['monto_pago']); ?>" required>

            <label for="vehiculo">Vehículo:</label>
            <select name="vehiculo" id="vehiculo" required>
                <option value="">Seleccione un vehículo</option>
                <?php foreach ($vehicles as $vehicle): ?>
                    <option value="<?php echo htmlspecialchars($vehicle['id']); ?>" <?php echo ($vehicle['id'] == $maintenanceData['id_vehiculo']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($vehicle['nombre'] . " - " . $vehicle['placa']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Modificar Mantenimiento</button>
        </form>

        
        <a href="?action=list" class="btn-back">Regresar al Listado de Mantenimientos</a>
    </div>

    <div id="alert" class="alert"></div>

    <script>
        document.getElementById('maintenanceForm').addEventListener('submit', function(e) {
            e.preventDefault(); 

            const formData = new FormData(this);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const alertDiv = document.getElementById('alert');
                alertDiv.textContent = data.message;
                alertDiv.style.display = 'block';

                
                if (data.status === 'success') {
                    this.reset();
                }

               
                setTimeout(() => {
                    alertDiv.style.display = 'none';
                }, 3000);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
