<?php
require_once '../Controller/UsuarioController.php';
require_once '../Model/Itvs.php';
session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    echo "<p>Hola administrador de " . (isset($usuario) ? $usuario->provincia : "") . "</p>";
    echo "<p>Telefono " . (isset($usuario) ? $usuario->telefono : "") . "</p>";
    echo "<a href='CerrarSesion.php'>Cerrar sesión</a>";
    echo "<h3>Gestion de citas de las ITV de " . (isset($usuario) ? $usuario->provincia : "") . "</h3>";

    $listaItv = UsuarioController::buscarProvincias($usuario->provincia);//busco en la sesion de usuario el dni y se lo añado aqui para que lo compare en el controller
//y lo guardo en la variable $cuentas que usare mas adelante
    
    
    if ($listaItv === false) {//si no existe cuentas para ese usuario es porque estaria en false
        echo 'No se encontraron cuentas asociadas a este usuario.<hr>';
    } elseif ($listaItv) {
        var_dump($listaItv);

        $_SESSION['lista'] = $listaItv;//aqui creo la sesion cuentas que me vale para transferencia.php
        // Comienza la tabla
        echo '<table border="1">';
        echo '<tr><th>Localidad</th><th>Direccion</th><th>citas</th></tr>';

        foreach ($listaItv as $value) {
            // Obtén IBAN y saldo de la cuenta
            $provincia = $value->localidad;
            $direccion = $value->direccion;
            $id = $value->id; //lo he cojido para ver citas
            // Muestra los datos en la tabla
            echo "<tr>";
            echo "<td>$provincia</td>";
            echo "<td>$direccion</td>";
            // Agrega dos columnas separadas para los botones
            echo '<td><form method="POST" action="verCitas.php"><input type="hidden" name="id_seleccionado" value="' . $id . '"><input type="submit" name="citas" value="ver citas"></form></td>';


            echo "</tr>";
        }

        // Finaliza la tabla
        echo '</table>';
    } else {
        echo 'Ocurrió un error al buscar las cuentas.<hr>';
    }
} else {
    // Manejar el caso en que el usuario no esté definido en la sesión
    echo "No se ha iniciado sesión.";
}










