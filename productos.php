<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Productos</title>
</head>
<body>
    <header>
        <button onclick="window.location.href='index.php'">HOME</button>
    </header>
    <main>
        <h1>PRODUCTOS</h1>
        <button onclick="openModal()">AGREGAR NUEVO PRODUCTO</button>

        <!-- ventana modal para agregar producto -->
         <div id="modal" class="modal">
            <div class="modal-content">
                <h2>Agregar productos</h2>
                <label>CÒDIGO</label>
                <input type="text" id="codigo" placeholder="Ingrese el codigo" required><br>

                <label>NOMBRE</label>
                <input type="text" id="nombre" placeholder="Ingrese nombre del producto" required><br>

                <label>PRECIO</label>
                <input type="number" id="precio" placeholder="Ingrese el precio" required><br>

                <label>STOCK</label>
                <input type="number" id="stock" placeholder="Ingrese la cantidad" required><br>

                <label>IVA</label>
                <input type="text" id="iva" placeholder="Ingrese el iva del producto" required><br>
                
                <button type="button" onclick="guardarproducto()">GUARDAR</button>
            </div>
         </div>
         <h2>LISTADO DE PRODUCTOS</h2>
         <table border=1>
            <thead>
                <th>CODIGO</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>STOCK</th>
                <th>IVA</th>
                <th>ACCION</th>
            </thead>
            <tbody id="tablaProductos">
                <!--aqui de aparecer los registros de la base de datos-->

            </tbody>
         </table>
    </main>
    <footer>

    </footer>
    <script src="js/script.js"></script>
</body>
</html>