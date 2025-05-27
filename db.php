<?php
// Configuración de la base de datos
$host = "localhost";
$usuario = "root";       // Cambia el usuario si es necesario
$contrasena = "";        // Coloca la contraseña de tu base de datos
$nombreDB = "cafeteria";

// Crear la conexión
$conn = new mysqli($host, $usuario, $contrasena, $nombreDB);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}
?>
