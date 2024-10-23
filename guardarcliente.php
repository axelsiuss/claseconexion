<?php 

// Incluir el archivo de conexión a la base de datos. 
// Este archivo 'conexion.php' debe contener el código que realiza la conexión a la base de datos (como los detalles del servidor, usuario, contraseña, etc.). 
include 'conexion.php'; 

/// Manejar la solicitud POST para insertar un nuevo cliente. 
// Esto se ejecuta cuando se envía el formulario para agregar un cliente nuevo. 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['action'])) { 
    // Obtener los datos enviados desde el formulario. 
    // '$_POST' es una manera de recoger los datos enviados desde el formulario HTML. 
    $codigo = $_POST['codigo']; 
    $nombre = $_POST['nombre']; 
    $apellido = $_POST['apellido']; 
    $documento = $_POST['documento']; 
    $direccion = $_POST['direccion']; 

    // Crear una consulta SQL para insertar estos datos en la tabla "clientes". 
    $sql = "INSERT INTO clientes (codigo, nombre, apellido, documento, direccion) VALUES ('$codigo', '$nombre', '$apellido', '$documento', '$direccion')";

    if (empty($codigo) || empty($nombre) || empty($apellido) || empty($documento) || empty($direccion)) {
        echo 'ERROR: LOS CAMPOS NO DEBEN ESTAR VACIOS, FAVOR COMPLETAR';
    }


    //ejecutar la consulta
    // Si la consulta se ejecuta correctamente, se muestra un mensaje de éxito. 
    if ($conn->query($sql) === TRUE) { 
        echo "Nuevo cliente agregado correctamente"; 
    } else { 
        // Si hay un error al insertar, se muestra un mensaje de error. 
        echo "Error al agregar el cliente: " . $conn->error; 
    } 
    // Salir del script después de procesar la solicitud. 
    exit; 
} 

// Manejar la solicitud POST para actualizar datos de un cliente. 
// Esto se ejecuta cuando el formulario envía una acción de actualización (action='update'). 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') { 
    // Obtener los datos del formulario enviados desde el modal de edición. 
    $codigo = $_POST['codigo']; 
    $nombre = $_POST['nombre']; 
    $apellido = $_POST['apellido']; 
    $documento = $_POST['documento']; 
    $direccion = $_POST['direccion']; 

    // Crear una consulta SQL para actualizar los datos del cliente basado en el "codigo". 
    $sql = "UPDATE clientes SET nombre='$nombre', apellido='$apellido', documento='$documento', direccion='$direccion' WHERE codigo='$codigo'"; 

    // Ejecutar la consulta. 
    // Si la actualización es exitosa, se muestra un mensaje de éxito. 
    if ($conn->query($sql) === TRUE) { 
        echo "Cliente actualizado correctamente"; 
    } else { 
        // Si ocurre un error, se muestra un mensaje de error. 
        echo "Error al actualizar el cliente: " . $conn->error; 
    } 
    // Salir del script después de procesar la solicitud. 
    exit; 
} 

// Manejar la solicitud GET para obtener los datos de un cliente específico. 
// Esto ocurre cuando se solicita información de un cliente para editar. 
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['codigo'])) { 
    // Se obtiene el "codigo" del cliente desde la URL (GET). 
    $codigo = $_GET['codigo']; 

    // Crear una consulta SQL para buscar el cliente en la base de datos. 
    $sql = "SELECT * FROM clientes WHERE codigo = '$codigo'"; 
    $result = $conn->query($sql); 

    // Si se encuentra el cliente, se convierte en un objeto JSON y se envía de vuelta. 
    if ($result->num_rows > 0) { 
        $cliente = $result->fetch_assoc(); // Convierte el resultado en un arreglo. 
        echo json_encode($cliente); // Envía los datos del cliente como un objeto JSON. 
    } else { 
        // Si no se encuentra el cliente, se envía un mensaje de error en formato JSON. 
        echo json_encode(["error" => "Cliente no encontrado"]); 
    } 
    // Salir del script después de procesar la solicitud. 
    exit; 
} 

// Obtener todos los clientes para mostrarlos en la tabla. 
// Esto se ejecuta cuando la página necesita cargar la lista completa de clientes. 
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['codigo'])) { 
    // Crear una consulta SQL para seleccionar todos los clientes de la tabla. 
    $sql = "SELECT * FROM clientes"; 
    $result = $conn->query($sql); 
    $clientes = array(); // Crear un arreglo vacío donde se almacenarán los datos. 

    // Si hay resultados, recorrer cada fila de la base de datos y agregarla al arreglo de clientes. 
    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { 
            $clientes[] = $row; // Agrega cada cliente al arreglo. 
        } 
    } 

    // Convertir el arreglo de clientes a JSON y enviarlo. 
    echo json_encode($clientes); 
    // Salir del script después de procesar la solicitud. 
    exit; 
} 

// Cerrar la conexión con la base de datos. 
$conn->close(); 
?>