<?php
session_start();

// Obtiene el objeto Usuarios de la sesión antes de destruir la sesión
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

// Destruye la sesión después de obtener la información del usuario
unset($_SESSION);
session_destroy();
setcookie("PHPSESSID", 0, time() - 100, "/");
header("Location: index.php");

?>

