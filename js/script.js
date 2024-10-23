// Función para abrir el modal
function openModal() {
    var modal = document.getElementById('modal');
    modal.style.display = "block";
}

// Función para cerrar el modal
function closeModal() {
    var modal = document.getElementById('modal');
    modal.style.display = "none";
}

// Evento click fuera del modal para cerrarlo
window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}

function guardarproducto(){
    //se obtienen los valores
    var codigo = document.getElementById('codigo').value;
    var nombre = document.getElementById('nombre').value;
    var precio = document.getElementById('precio').value;
    var stock = document.getElementById('stock').value;
    var iva = document.getElementById('iva').value;

    //se crea la peticio al servidor
    var xhr = new XMLHttpRequest();
    //se especifica el archivo servidor y el metodo
    xhr.open('POST', 'guardarproducto.php', true);
    //que tipo de dato recibira el servidor
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');//que harà el front al recibir respuesta del servidor
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){ //mostrar mensaje en el front
            alert(xhr.responseText);
            //como la pagina no se actualiza hay que limpiar los campos de textos para
            //la segunda insercion
            closeModal();
            document.getElementById('codigo').value ="";
            document.getElementById('nombre').value ="";
            document.getElementById('precio').value ="";
            document.getElementById('stock').value ="";
            document.getElementById('iva').value ="";

            //invocar cargartabla
            obtenerProductos();
        }
    }
    //enviar los datos al back para la insercion
    xhr.send(
        'codigo=' + encodeURIComponent(codigo)+
        '&nombre=' + encodeURIComponent(nombre)+
        '&precio=' + encodeURIComponent(precio) +
        '&stock=' + encodeURIComponent(stock) + 
        '&iva=' + encodeURIComponent(iva)        
    );
}

function guardarproveedor(){
    //se obtienen los valores
    var codigo = document.getElementById('codigo').value;
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var ciudad = document.getElementById('ciudad').value;
    var direccion = document.getElementById('direccion').value;
    var telefono = document.getElementById('telefono').value;

    //se crea la peticio al servidor
    var xhr = new XMLHttpRequest();
    //se especifica el archivo servidor y el metodo
    xhr.open('POST', 'guardarproveedor.php', true);
    //que tipo de dato recibira el servidor
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    //que harà el front al recibir respuesta del servidor
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            //mostrar mensaje en el front
            alert(xhr.responseText);
            //como la pagina no se actualiza hay que limpiar los campos de textos para
            //la segunda insercion
            closeModal();
            document.getElementById('codigo').value ="";
            document.getElementById('nombre').value ="";
            document.getElementById('apellido').value ="";
            document.getElementById('ciudad').value ="";
            document.getElementById('direccion').value ="";
            document.getElementById('telefono').value ="";
        }
    }
    //enviar los datos al back para la insercion
    xhr.send(
        'codigo=' + encodeURIComponent(codigo)+
        '&nombre=' + encodeURIComponent(nombre)+
        '&apellido=' + encodeURIComponent(apellido) +
        '&ciudad=' + encodeURIComponent(ciudad) + 
        '&direccion=' + encodeURIComponent(direccion)+
        '&telefono=' + encodeURIComponent(telefono)               
    );
}

function obtenerProductos() {
    //se crea la peticion
    var xhr = new XMLHttpRequest();
    //se configura la solicitud HTTP que llamara a proceso:php
    xhr.open('GET', 'guardarproducto.php', true);
    //utilizaremos get porque no habra paso de valores
    //no definimos la forma de tipo de datos que recibira el back
    //porque no recibira valores

    //definir una funcion que ejecutara al recibir la respuesta del back
    xhr.onreadystatechange=function () {
        //verificar si la solicitud termina y si fue exitosa
        if (xhr.readyState==4 && xhr.status==200) {
            //aqui debe realizarse las acciones recibidas del back
            var productos= JSON.parse(xhr.responseText);

            //se obtiene el id de donde queremos mostrar los valores 
            var tablap=document.getElementById('tablaProductos');
            //limpiar la tabla entre cada inserccion(para no duplicar)
            tablap.innerHTML='';
            productos.forEach(function(producto){
                //se crea la fila en el cuerpo de la tabla
                var fila = document.createElement('tr');
                fila.innerHTML='<td>'+producto.idproductos+'</td>'+
                                '<td>'+producto.pro_nombre+'</td>'+
                                '<td>'+producto.pro_precio+'</td>'+
                                '<td>'+producto.pro_stock+'</td>'+
                                '<td>'+producto.pro_iva+'</td>'+
                                '<td>'+
                                '<button>EDITAR</button>'+
                                '<button>ELIMINAR</button>'
                                '</td>';
                tablap.appendChild(fila);

            });
            
        }
    }
    xhr.send();
}

window.onload = function() {
    obtenerProductos();
    obtenerProveedores();
    obtenerClientes();
};


function obtenerProveedores() {
    var xhr= new XMLHttpRequest();

    xhr.open('GET', 'guardarproveedor.php', true);

    xhr.onreadystatechange= function() {
        if (xhr.readyState==4 && xhr.status==200) {
            var proveedores= JSON.parse(xhr.responseText);

            var tablaProveedores=document.getElementById('tablaproveedores');

            tablaProveedores.innerHTML = '';

            proveedores.forEach(function (proveedores) {
                var fila= document.createElement('tr');
                fila.innerHTML = '<td>' + proveedores.idproveedores + '</td>' +
                                '<td>' + proveedores.prov_nombre + '</td>' +
                                '<td>' + proveedores.prov_apellido + '</td>' +
                                '<td>' + proveedores.prov_ciudad + '</td>' +
                                '<td>' + proveedores.prov_direccion + '</td>' +
                                '<td>' + proveedores.prov_telefono + '</td>' +
                                '<td>' +
                                '<button>EDITAR</button>' +
                                '<button>ELIMINAR</button>' +
                                '</td>';

                tablaProveedores.appendChild(fila);
            });
        }
    }
    xhr.send();
}


// Función para limpiar el resultado y cerrar el modal 
function limpiarResultado() { 
    document.getElementById('resultado').textContent = ''; // Limpia el contenido del elemento con ID 'resultado' 
    closeModal(); // Cierra e modal después de limpiar el resultado 
} 

