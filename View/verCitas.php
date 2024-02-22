<?php
require_once '../Controller/UsuarioController.php';
require_once '../Model/Itvs.php';
require_once '../Model/Citas.php';
session_start();
$idSeleccionado = isset($_POST['id_seleccionado']) ? $_POST['id_seleccionado'] : ''; //recojo 
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    
    echo "<p>Hola administrador de " . (isset($usuario) ? $usuario->provincia : "") . "</p>";
    echo "<p>Telefono " . (isset($usuario) ? $usuario->telefono : "") . "</p>";
    echo "<a href='CerrarSesion.php'>Cerrar sesión</a>";
    echo "<h3>Gestion de citas de las ITV de " . (isset($usuario) ? $usuario->provincia : "") . "</h3>";

    $listarCitas = UsuarioController::buscarCitas($idSeleccionado);
    var_dump($listarCitas);
    $listarVehiculos = UsuarioController::buscarVehiculos2($idSeleccionado);
    var_dump($listarVehiculos);

    if ($listarVehiculos === false) {
        echo 'No se encontraron cuentas asociadas a este usuario.<hr>';
    } elseif ($listarVehiculos) {
        echo '<table border="1">';
        echo '<tr><th>Matricula</th><th>Marca</th><th>Modelo</th><th>Fecha</th><th>Hora</th></tr>';

        foreach ($listarVehiculos as $value) {
            $matricula = $value['matricula'];//esto viene de un array no de un objeto
            $marca = $value['marca']; 
            $modelo = $value['modelo'];
            $fecha = $value['fecha']; 
            $hora = $value['hora'];


            echo "<tr>";
            echo "<td>$matricula</td>";
            echo "<td>$marca</td>";
            echo "<td>$modelo</td>";
            echo "<td>$fecha</td>";
            echo "<td>$hora</td>";
            
            echo '<td><form method="POST" action="verCitas.php"><input type="hidden" name="id_seleccionado" value="' . $modelo . '"><input type="submit" name="citas" value="ver citas"></form></td>';
            
            echo "</tr>";
        }

        echo '</table>';
    } else {
        echo 'Ocurrió un error al buscar las cuentas.<hr>';
    }
} else {
    echo "No se ha iniciado sesión.";
}

