<?php
session_start();

$archivo = 'mensajes.txt';
$archivo_respuestas = 'respuestas.txt';

// Conexión a la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

    date_default_timezone_set('America/La_Paz');
    ?>