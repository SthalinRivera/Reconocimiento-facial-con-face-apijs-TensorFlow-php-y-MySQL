<?php
$remote_host = '119.8.151.204';  // Cambiar a tu dirección IP remota
$remote_user = 'admin';          // Cambiar al usuario remoto
$remote_pass = 'Ac3ss2067@';     // Cambiar a la contraseña remota
$remote_db = 'dbsivireno';  // Cambiar al nombre de tu base de datos remota

// Establecer la conexión
$conn_remote = new mysqli($remote_host, $remote_user, $remote_pass, $remote_db, 3306);

// Verificar la conexión
if ($conn_remote->connect_error) {
    die("Conexión fallida: " . $conn_remote->connect_error);
}

?>