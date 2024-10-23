<?php
// Incluir la conexión
include 'conexion.php';

// Verificar si se recibieron datos a través de POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos enviados desde el formulario
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Validar si los campos requeridos están vacíos
    if (empty($codigo) || empty($nombre) || empty($apellido) || empty($ciudad) || empty($direccion) || empty($telefono)) {
        echo "Error: Los datos deben ser completados para su guardado. Favor completar";
    } else {
        // Crear el SQL para la inserción
        $stmt = $conn->prepare("INSERT INTO proveedores (idproveedores, prov_nombre, prov_apellido, prov_ciudad, prov_direccion, prov_telefono) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $codigo, $nombre, $apellido, $ciudad, $direccion, $telefono);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "PROVEEDOR GUARDADO";
        } else {
            echo "ERROR AL INSERTAR: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    }
} elseif($_SERVER["REQUEST_METHOD"]=="GET"){

    $result=$conn->query("SELECT * FROM proveedores");

    $proveedores = array();

    while ($row=$result->fetch_assoc()) {
        $proveedores[]=$row;
    }

    echo json_encode($proveedores);

    $conn->close();


}else {
    echo "ERROR: No se recibieron datos.";
}
?>
