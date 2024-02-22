<?php
require_once '../Controller/UsuarioController.php';
session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    echo "<p>Hola administrador de " . (isset($usuario) ? $usuario->provincia : "") . "</p>";
    echo "<p>Telefono " . (isset($usuario) ? $usuario->telefono : "") . "</p>";
    echo "<a href='CerrarSesion.php'>Cerrar sesión</a>";
    echo "<h3>Gestion de citas de las ITV de " . (isset($usuario) ? $usuario->provincia : "") . "</h3>";
    ?>

<div class="allign-center">
        <a href='nuevacita.php'>Registrar nueva cita</a>
        <a href='listaitvs.php'>Listado de sedes de ITV</a>
    </div>

    <?php
}
