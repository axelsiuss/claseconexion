<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "conexionphp"; //NO OLVIDAR DE CAMBIAR EL NOMBRE DE LA BASE DE DATOS

//crear la conexion 
$conn = new mysqli($hostname, $username, $password, $dbname);

//verificar la conexion
if($conn->connect_error){
    die("ERROR DE CONEXION: " . $conn->connect_error);
}
?>