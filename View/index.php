<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>

    <body>
        <?php
        require_once '../Controller/UsuarioController.php';
        session_start();

        if (isset($_POST['iniciar'])) {
            $usuario = UsuarioController::buscarUsuarios($_POST['usuario']); //meto los datos que me han salido aqui en una variable $usuario
            //// es un objeto vaya un array de cosas

            if ($usuario === false) {// si la variable es falsa osea no hay coincidencias en el usuario puesto en el login
                echo "Usuario no existe";
            } else {

                $claveIngresada = $_POST["clave"]; // Aquí obtienes la clave del formulario

                if (password_verify($claveIngresada, $usuario->pass)) {
                    $_SESSION['usuario'] = $usuario;
                    header("location:menu.php");
                    exit();
                } else {
                    echo 'La contraseña es incorrecta';
                }
            }
        }
        ?>

        <h3>Gestion De citas ITV ANDALUCIA</h3> 

        <form action="" method="POST">
            Usuario (DNI): <input type="text" name="usuario"><br>
            Clave: <input type="password" name="clave"><br><br>
            <input type="submit" name="iniciar" value="Acceder">
        </form>
    </body>
</html>

