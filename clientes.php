Vista cliente.php
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"> <!-- Define el tipo de codificación de caracteres, en este caso UTF-8 para admitir todos los caracteres especiales y acentos -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Esto asegura que el sitio se vea bien en dispositivos móviles ajustando el ancho de la página al ancho de la pantalla del dispositivo -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Conecta este archivo HTML a un archivo CSS externo llamado "style.css", que contiene estilos para la apariencia de la página -->
    <title>Clientes</title> <!-- El título de la página que aparecerá en la pestaña del navegador -->
</head>

<body>
    <header>
    <button onclick="window.location.href='index.php'">HOME</button>  <!-- Esta es la cabecera de la página, por ahora está vacía, pero es donde podrías poner un logo o un menú de navegación -->
    </header>

    <main>
        <!-- El contenido principal de la página irá aquí -->

        <button onclick="openModal()">GUARDAR</button> <!-- Un botón que, cuando se hace clic, llama a una función de JavaScript llamada "openModal()" para abrir una ventana modal -->

        <!-- Ventana modal para guardar nuevos clientes -->
        <div id="modal" class="modal"> <!-- Un contenedor de la ventana modal que está oculta inicialmente -->
            <div class="modal-content"> <!-- El contenido de la ventana modal -->
                <span class="close" onclick="closeModal()">&times;</span> <!-- El botón "x" para cerrar la ventana modal, llama a la función "closeModal()" -->
                <h1>FORMULARIO CLIENTES</h1> <!-- Título del formulario -->

                <!-- Campos de entrada de datos para el formulario -->
                <label for="codigo">Codigo:</label> <!-- Etiqueta para el campo de código -->
                <input type="text" id="codigo" name="codigo" required><br> <!-- Entrada de texto para el código del cliente -->

                <label for="nombre">Nombre:</label> <!-- Etiqueta para el campo de nombre -->
                <input type="text" id="nombre" name="nombre" required><br> <!-- Entrada de texto para el nombre del cliente -->

                <label for="apellido">Apellido:</label> <!-- Etiqueta para el campo de apellido -->
                <input type="text" id="apellido" name="apellido" required><br> <!-- Entrada de texto para el apellido del cliente -->

                <label for="documento">Documento de Identidad:</label> <!-- Etiqueta para el documento de identidad -->
                <input type="text" id="documento" name="documento" required><br> <!-- Entrada de texto para el documento de identidad del cliente -->

                <label for="direccion">Dirección:</label> <!-- Etiqueta para la dirección -->
                <input type="text" id="direccion" name="direccion" required><br> <!-- Entrada de texto para la dirección del cliente -->

                <button type="button" id="guardarBtn"
                    onclick="guardarcliente()">Guardar</button> <!-- Botón que guarda los datos al hacer clic, llama a la función "guardarcliente()" de JavaScript -->
            </div>
        </div>

        <!-- Tabla dinámica para listar los clientes -->
        <h2>Listado de Clientes</h2> <!-- Título de la sección que muestra la lista de clientes -->

        <!-- Aquí se crea una tabla para mostrar los clientes que se han guardado -->
        <table border="1"> <!-- La tabla tiene un borde para hacerla visible -->
            <thead>
                <!-- Encabezado de la tabla, que describe qué datos se mostrarán en cada 
columna -->
                <tr>
                    <th>Codigo</th> <!-- Columna para el código del cliente -->
                    <th>Nombre</th> <!-- Columna para el nombre del cliente -->
                    <th>Apellido</th> <!-- Columna para el apellido del cliente -->
                    <th>Documento</th> <!-- Columna para el documento del cliente -->
                    <th>Dirección</th> <!-- Columna para la dirección del cliente -->
                    <th>ACCION</th> <!-- Columna para los botones de acción, como modificar o eliminar -->
                </tr>
            </thead>
            <tbody id="tablaClientes">
                <!-- Aquí es donde se agregarán dinámicamente los datos de los clientes con JavaScript -->
            </tbody>
        </table>

        <!-- Modal para editar cliente existente -->
        <div id="editModal" class="modal"> <!-- Otro contenedor modal, pero este es para editar un cliente existente -->
            <div class="modal-content"> <!-- El contenido de la ventana modal -->
                <span class="close" onclick="closeEditModal()">&times;</span> <!-- Botón "x" para cerrar el modal de edición -->
                <h2>Editar Cliente</h2> <!-- Título del formulario de edición -->

                <!-- Formulario de edición con campos prellenados con los datos del cliente -->
                <form id="editForm">
                    <label for="editCodigo">Codigo:</label> <!-- Etiqueta para el código -->
                    <input type="text" id="editCodigo" readonly><br> <!-- El código es de solo lectura, no se puede editar -->

                    <label for="editNombre">Nombre:</label> <!-- Etiqueta para el nombre -->
                    <input type="text" id="editNombre"><br> <!-- Campo para editar el nombre del cliente -->

                    <label for="editApellido">Apellido:</label> <!-- Etiqueta para el apellido -->
                    <input type="text" id="editApellido"><br> <!-- Campo para editar el apellido del cliente -->

                    <label for="editDocumento">Documento:</label> <!-- Etiqueta para el documento -->
                    <input type="text" id="editDocumento"><br> <!-- Campo para editar el documento del cliente -->

                    <label for="editDireccion">Dirección:</label> <!-- Etiqueta para la dirección -->
                    <input type="text" id="editDireccion"><br> <!-- Campo para editar la dirección del cliente -->

                    <button type="button" onclick="guardarEdicion()">Guardar
                        Cambios</button> <!-- Botón que guarda los cambios al hacer clic, llama a la función "guardarEdicion()" -->
                </form>
            </div>
        </div>
    </main>

    <footer>
        <!-- El pie de página de la página, está vacío, pero podrías agregar texto o enlaces aquí -->
    </footer>

    <script src="js/clientes.js"></script> <!-- Enlace al archivo JavaScript que contiene la lógica de la página -->
</body>

</html>