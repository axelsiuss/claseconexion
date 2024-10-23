<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Proveedores</title>
</head>
<body>
    <header>
        <button onclick="window.location.href='index.php'">HOME</button>
    </header>
    <main>
        <h1>Proveedores</h1>
        <button onclick="openModal()">AGREGAR DATOS DEL PROVEEDOR</button>

        <!--VENTANA MODAL PARA PROVEEDORES--->
        <div id="modal" class="modal">
            <div class="modal-content">
                <h2>Datos del proveedor</h2>
                <label>Codigo</label>
                <input type="text" id="codigo" placeholder="Ingrese el codigo proveedor" required> <br>

                <label>Nombre</label>
                <input type="text" id="nombre" placeholder="Ingrese el nombre del proveedor" required> <br>

                <label>Apellido</label>
                <input type="text" id="apellido" placeholder="ingrese el apellido del proveedor" required> <br>

                <label>Ciudad</label>
                <input type="text" id="ciudad" placeholder="ingrese la ciudad" required> <br>

                <label>Direccion</label>
                <input type="text" id="direccion" placeholder="ingrese la direccion" required> <br>

                <label>Telefono</label>
                <input type="number" id="telefono" placeholder="Ingrese el telefono" required> <br>

                <button type="button" onclick="guardarproveedor()">GUARDAR</button>
            </div>
        </div>
        <h2>Listado de provedores</h2>
        <table border=1>
            <thead>
                <th>CODIGO</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>CIUDAD</th>
                <th>DIRECCION</th>
                <th>TELEFONO</th>
            </thead>
            <tbody id="tablaproveedores">
                
            </tbody>
        </table>
    </main>
    <footer>

    </footer>
    
    <script src="js/script.js"></script>
</body>
</html> 