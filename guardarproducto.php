<?php
// Incluir la conexión
include 'conexion.php';

// Verificar si se recibieron datos a través de POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos enviados desde el formulario
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $iva = $_POST['iva'];

    // Validar si los campos requeridos están vacíos
    if (empty($codigo) || empty($nombre) || empty($precio) || empty($stock) || empty($iva)) {
        echo "ERROR: Todos los campos son obligatorios. Por favor complete todos los datos.";
    } else {
        // Crear el SQL para la inserción
        $stmt = $conn->prepare("INSERT INTO productos (idproductos, pro_nombre, pro_precio, pro_stock, pro_iva) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isiis", $codigo, $nombre, $precio, $stock, $iva);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "PRODUCTO GUARDADO";
        } else {
            echo "ERROR AL INSERTAR: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    }
} elseif($_SERVER["REQUEST_METHOD"]=="GET"){
        //si entra aqui es porque se activo el metodo GET
        //se crea el sql y se guarda en la variable result
        $result = $conn->query("SELECT * FROM productos");

        //se crea un arreglo para que pueda contener los resultados

        $productos = array();

        //vamos a ejecutar el sql y el resultado recorre por fila 
        // y almacenar dentro del array productos

        while($row = $result->fetch_assoc()){
            $productos[] = $row;
        }

        //convoerte el array producto en formato json y envia a productos.php
        echo json_encode($productos);

        $conn->close();

    
    }else {
    echo "ERROR: No se recibieron datos.";
}
?>
