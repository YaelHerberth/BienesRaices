<?php
// Importar la conexion
include 'includes/config/database.php';
$db = conectarDB();

// Crear un email y contraseña
$email = 'admin@admin.com';
$password = '123456';
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Query para crear el usuario
$query = "INSERT INTO usuarios(email,password)VALUES('{$email}','{$passwordHash}')";

// Agregar a la base de datos
mysqli_query($db,$query);
