<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Mantenimiento</title>
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        /*Mensaje flotante */
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

        /* Estilo para el botón de listado */
        .button-list {
            margin-top: 15px;
            text-align: center;
        }

        .button-list a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .button-list a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registro de Mantenimiento</h1>
        <form id="maintenanceForm" action="" method="POST">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required>

            <label for="detalle">Detalle de Mantenimiento:</label>
            <input type="text" name="detalle" id="detalle" required>

            <label for="monto_pago">Monto de Pago:</label>
            <input type="number" name="monto_pago" id="monto_pago" step="0.01" required>

            <label for="vehiculo">Vehículo:</label>
            <select name="vehiculo" id="vehiculo" required>
                <option value="">Seleccione un vehículo</option>
                <?php foreach ($vehicles as $vehicle): ?>
                    <option value="<?php echo htmlspecialchars($vehicle['id']); ?>">
                        <?php echo htmlspecialchars($vehicle['nombre'] . " - " . $vehicle['placa']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Registrar Mantenimiento</button>
        </form>

        <div class="button-list">
            <a href="?action=list">Listar Mantenimientos</a> 
        </div>
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
