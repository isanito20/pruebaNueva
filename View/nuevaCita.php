<?php
require_once '../Controller/UsuarioController.php';
session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    echo "<p>Hola administrador de " . (isset($usuario) ? $usuario->provincia : "") . "</p>";
    echo "<p>Telefono " . (isset($usuario) ? $usuario->telefono : "") . "</p>";
    echo "<a href='CerrarSesion.php'>Cerrar sesión</a>";
    echo "<h3>Gestion de citas de las ITV de " . (isset($usuario) ? $usuario->provincia : "") . "</h3>";

    if (isset($_POST['buscar'])) {
        $listaVehiculos = UsuarioController::buscarVehiculoObjeto($_POST['matricula']);
        $matriculaCreada = UsuarioController::buscarCitasParaExistir($_POST['matricula']);
        if ($listaVehiculos === FALSE) {
            echo 'no hay ninguna matricula';
        } else {
            if ($matriculaCreada==TRUE){
                echo 'exisste una cita para el dia ' . $matriculaCreada->fecha . ' a la hora ' . $matriculaCreada->hora . 'en la localidad de '
                        . /*$usuario->localidad*/ ' de la provincia de ' . $usuario->provincia;
            }
            else {
                var_dump($listaVehiculos);
            ?>


            <label for=" Matricula: ">Matricula:</label>
            <input readonly="FALSE" type="text" value="<?php echo $listaVehiculos->matricula; ?>" name="origen"><br>

            <label for="Marca: ">Marca:</label>
            <input readonly="FALSE" type="text" value="<?php echo $listaVehiculos->marca; ?>" name="destino"><br>

            <label for="Modelo: ">Modelo:</label>
            <input readonly="FALSE" type="text" value="<?php echo $listaVehiculos->modelo; ?>" name="cantidad_seleccionada"><br>

            <label for="Color: ">Color:</label>
            <input readonly="FALSE" type="text" value="<?php echo $listaVehiculos->color; ?>" name="comision"><br>

            <label for="plazas: ">plazas: </label>
            <input readonly="FALSE" type="number" value="<?php echo $listaVehiculos->plazas; ?>" name="saldo_anteriorSeleccionado"><br>

            <label for="Fecha_ultima_revisionrior: ">Fecha_ultima_revisionrior:</label>
            <input readonly="FALSE" type="date" value="<?php echo $listaVehiculos->fecha_ultima_revision; ?>" name="saldo_posteriorSeleccionado"><br>
            <?php
            }
            
        }
    } else {
        ?>
        <form action="" method="POST">
            <input type="text" name="matricula"/>
            <input type="submit" name="buscar" value="buscar"/>
        </form>

        <?php
    }
}


    