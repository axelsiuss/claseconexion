
// Función para abrir el modal 
function openModal() {
    var modal = document.getElementById('modal'); // Obtiene el elemento del modal usando su ID 
    modal.style.display = "block"; // Cambia el estilo del modal para hacerlo visible (se muestra en la pantalla) 
}

// Función para cerrar el modal 
function closeModal() {
    var modal = document.getElementById('modal'); // Obtiene el elemento del modal 
    modal.style.display = "none"; // Cambia el estilo del modal para ocultarlo (no se muestra en la pantalla) 
}

// Evento click fuera del modal para cerrarlo 
window.onclick = function (event) {
    // Verifica si el clic fue en el área del modal (fuera del contenido) 
    if (event.target == modal) {
        closeModal(); // Si es así, cierra el modal 
    }
};

// Función para limpiar el resultado y cerrar el modal 
function limpiarResultado() {
    document.getElementById('resultado').textContent = ''; // Limpia el contenido del elemento con ID 'resultado' 
    closeModal(); // Cierra el modal después de limpiar el resultado 
}

// Función para guardar un nuevo cliente 
function guardarcliente() {
    // Obtener los valores ingresados en los campos de texto del formulario 
    var codigo = document.getElementById('codigo').value; // Captura el valor del campo 'codigo'
    var nombre = document.getElementById('nombre').value; // Captura el valor del campo 'nombre'
    var apellido = document.getElementById('apellido').value; // Captura el valor del campo 'apellido' 
    var documento = document.getElementById('documento').value; // Captura el valor del campo 'documento' 
    var direccion = document.getElementById('direccion').value; // Captura el valor del campo 'direccion' 

    // Crear un nuevo "pedido" al servidor usando XMLHttpRequest 
    var xhr = new XMLHttpRequest(); // Crea una nueva instancia de XMLHttpRequest para realizar una solicitud 
    xhr.open('POST', 'guardarcliente.php', true); // Configura la solicitud como 'POST' para el archivo 'proceso.php' 
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // Establece el tipo de contenido 

    // Define lo que sucede cuando cambia el estado de la solicitud 
    xhr.onreadystatechange = function () {
        // Verifica si la solicitud ha terminado (readyState == 4) y si la respuesta fue  exitosa(status == 200)
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText); // Muestra una alerta con la respuesta del servidor 
            closeModal(); // Cierra el modal 
            // Limpia los campos del formulario después de guardar el cliente 
            document.getElementById('codigo').value = '';
            document.getElementById('nombre').value = '';
            document.getElementById('apellido').value = '';
            document.getElementById('documento').value = '';
            document.getElementById('direccion').value = '';

            // Actualizar el listado de clientes después de guardar uno nuevo 
            obtenerClientes(); // Llama a la función para cargar la lista de clientes 
            actualizada
        }
    };

    // Envía los datos al servidor 
    xhr.send(
        'codigo=' + encodeURIComponent(codigo) + // Envia el código 
        '&nombre=' + encodeURIComponent(nombre) + // Envia el nombre 
        '&apellido=' + encodeURIComponent(apellido) + // Envia el apellido 
        '&documento=' + encodeURIComponent(documento) + // Envia el documento 
        '&direccion=' + encodeURIComponent(direccion) // Envia la dirección 
    );
}

// Función para obtener y mostrar el listado de clientes 
function obtenerClientes() {
    var xhr = new XMLHttpRequest(); // Crea una nueva instancia de XMLHttpRequest 

    // Configura la solicitud HTTP para obtener los datos 
    xhr.open('GET', 'guardarcliente.php', true); // Configura la solicitud como 'GET' para el archivo 'proceso.php' 

    // Define lo que sucede cuando cambia el estado de la solicitud 
    xhr.onreadystatechange = function () {
        // Verifica si la solicitud ha terminado y fue exitosa 
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Analiza el texto de respuesta JSON recibido del servidor y lo convierte en un objeto JavaScript 
            var clientes = JSON.parse(xhr.responseText); // Convierte la respuesta de texto en un objeto JavaScript 

            var tablaClientes = document.getElementById('tablaClientes'); // Obtiene el elemento de la tabla donde se mostrarán los datos 

            tablaClientes.innerHTML = ''; // Limpia el contenido actual de la tabla para evitar datos duplicados 

            // Recorre la lista de clientes obtenidos del servidor 
            clientes.forEach(function (cliente) {
                // Crea una nueva fila de tabla (tr) para cada cliente 
                var fila = document.createElement('tr');

                // Establece el contenido HTML de la fila con los datos del cliente 
                fila.innerHTML = '<td>' + cliente.codigo + '</td>' +
                    '<td>' + cliente.nombre + '</td>' +
                    '<td>' + cliente.apellido + '</td>' +
                    '<td>' + cliente.documento + '</td>' +
                    '<td>' + cliente.direccion + '</td>' +
                    '<td>' +
                    '<button onclick="modificarCliente(\'' + cliente.codigo +
                    '\')">Modificar</button>' + // Botón para modificar 
                    '<button onclick="eliminarCliente(\'' + cliente.codigo +
                    '\')">Eliminar</button>' + // Botón para eliminar 
                    '<button onclick="imprimirCliente(\'' + cliente.codigo +
                    '\')">Imprimir</button>' + // Botón para imprimir 
                    '</td>';

                // Añade la fila recién creada a la tabla 
                tablaClientes.appendChild(fila); // Agrega la nueva fila a la tabla 
            });
        }
    }

    // Envía la solicitud al servidor para obtener los datos 
    xhr.send(); // Una vez enviada la solicitud, el código espera recibir la respuesta 
}

// Llamar a la función para cargar los clientes al cargar la página 
window.onload = obtenerClientes; // Esto ejecuta la función obtenerClientes cuando la ventana se ha cargado completamente 

// Función para abrir el modal de edición y llenar los campos con los datos del cliente seleccionado
function modificarCliente(codigo) {
    var modal = document.getElementById('editModal'); // Obtiene el modal de edición 
    modal.style.display = "block"; // Muestra el modal 

    // Obtener los datos del cliente a través de AJAX y llenar el formulario 
    var xhr = new XMLHttpRequest(); // Crea una nueva instancia de XMLHttpRequest 
    xhr.open('GET', 'guardarcliente.php?codigo=' + codigo, true); // Configura la solicitud para obtener los datos del cliente específico 
    xhr.onreadystatechange = function () {
        // Verifica si la solicitud ha terminado y fue exitosa 
        if (xhr.readyState == 4 && xhr.status == 200) {
            var cliente = JSON.parse(xhr.responseText); // Convierte la respuesta en un objeto JavaScript 
            // Rellena los campos del formulario de edición con los datos del cliente 
            document.getElementById('editCodigo').value = cliente.codigo;
            document.getElementById('editNombre').value = cliente.nombre;
            document.getElementById('editApellido').value = cliente.apellido;
            document.getElementById('editDocumento').value = cliente.documento;
            document.getElementById('editDireccion').value = cliente.direccion;
        }
    };
    xhr.send(); // Envía la solicitud para obtener los datos del cliente 
}

// Función para cerrar el modal de edición 
function closeEditModal() {
    var modal = document.getElementById('editModal'); // Obtiene el modal de edición 
    modal.style.display = "none"; // Oculta el modal 
}

// Función para guardar los cambios editados 
function guardarEdicion() {
    var codigo = document.getElementById('editCodigo').value; // Obtiene el código del cliente 
    var nombre = document.getElementById('editNombre').value; // Obtiene el nuevo nombre 
    var apellido = document.getElementById('editApellido').value; // Obtiene el nuevo apellido 
    var documento = document.getElementById('editDocumento').value; // Obtiene el nuevo documento 
    var direccion = document.getElementById('editDireccion').value; // Obtiene la nueva dirección 

    // Enviar la solicitud para actualizar los datos del cliente 
    var xhr = new XMLHttpRequest(); // Crea una nueva instancia de XMLHttpRequest 
    xhr.open('POST', 'guardarcliente.php', true); // Configura la solicitud como 'POST' para el archivo 'proceso.php' 
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // Establece el tipo de contenido 

    // Define lo que sucede cuando cambia el estado de la solicitud 
    xhr.onreadystatechange = function () {
        // Verifica si la solicitud ha terminado y fue exitosa 
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText); // Muestra un mensaje con la respuesta del servidor 
            closeEditModal(); // Cierra el modal de edición 
            obtenerClientes(); // Actualiza la tabla con los datos nuevos 
        }
    };

    // Envía los datos del cliente editado al servidor 
    xhr.send(
        'codigo=' + encodeURIComponent(codigo) + // Envía el código 
        '&nombre=' + encodeURIComponent(nombre) + // Envía el nuevo nombre 
        '&apellido=' + encodeURIComponent(apellido) + // Envía el nuevo apellido 
        '&documento=' + encodeURIComponent(documento) + // Envía el nuevo documento 
        '&direccion=' + encodeURIComponent(direccion) + // Envía la nueva dirección 
        '&action=update' // Indica que se trata de una actualización 
    );
}
