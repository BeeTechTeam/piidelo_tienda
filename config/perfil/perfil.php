<?php
require_once("../../database/connection.php");
/**Creamos la conexi&oacute;n */
$connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");

/**Recibimos el m&eacute;todo */
$metodo = $_POST["metodo"];

switch ($metodo) {
    case "ActualizarInformacion":
        $apellidos = utf8_encode(trim($_POST["apellidos"]));
        $cliente = trim($_POST["cliente"]);
        $usuario = trim($_POST["usuario"]);
        $direccion = utf8_encode(trim($_POST["direccion"]));
        $dni = trim($_POST["dni"]);
        $email = trim($_POST["email"]);
        $nombres = utf8_encode(trim($_POST["nombres"]));
        $razon_social = utf8_encode(trim($_POST["razon_social"]));
        $telefono = trim($_POST["telefono"]);

        function actualizar_informacion($apellidos, $direccion, $dni, $email, $nombres, $razon_social, $telefono, $cliente, $usuario, $connection)
        {
            $response = [];
            $update_cliente = "update cliente set 
                cli_ruc = '" . $dni . "',
                cli_razon_social = '" . $razon_social . "',
                cli_telefono = '" . $telefono . "',
                cli_email = '" . $email . "',
                cli_direccion = '" . $direccion . "'
                where cli_id = '" . $cliente . "' and cli_estado = 'ACTIVO'";
            if (mysqli_query($connection, $update_cliente) === true) {
                $update_usuario = "update usuario set 
                usu_nombres = '" . $nombres . "',
                usu_apellidos = '" . $apellidos . "',
                usu_usuario = '" . $email . "'
                where usu_id = '" . $usuario . "' and usu_estado = 'ACTIVO'";
                if (mysqli_query($connection, $update_usuario) === true) {
                    $cliente__ = array(
                        "apellidos" => utf8_decode($apellidos),
                        "nombres" => utf8_decode($nombres),
                        "codigo" => $cliente,
                        "codigo_usuario" => $usuario,
                        "direccion" => utf8_decode($direccion),
                        "email" => $email,
                        "razon_social" => utf8_decode($razon_social),
                        "ruc" => $dni,
                        "telefono" => $telefono,
                        "usuario" => $email,
                    );
                    $response = array(
                        "codigo" => 111,
                        "mensaje" => "Datos personales actualizados correctamente",
                        "cliente" => $cliente__
                    );
                } else {
                    $response = array(
                        "codigo" => 110,
                        "mensaje" => "Error al actualizar tus datos personales"
                    );
                }
            } else {
                $response = array(
                    "codigo" => 110,
                    "mensaje" => "Error al actualizar tus datos personales"
                );
            }

            echo json_encode($response);
        }

        actualizar_informacion($apellidos, $direccion, $dni, $email, $nombres, $razon_social, $telefono, $cliente,  $usuario, $connection);
        break;

    case "ActualizarPassword":
        /**Recibimos datos */
        $codigo = $_POST["usuario"];
        $password_old = $_POST["password_old"];
        $password_new = $_POST["password_new"];

        function actualizar_password($codigo, $password_new, $password_old, $connection)
        {
            $select = "select usu_password from usuario where usu_id = '" . $codigo . "'";
            $result = mysqli_query($connection, $select);
            $response = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $password_act = $row["usu_password"];
                }
            }
            $result->close();
            if ($password_old === $password_act) {
                $update = "update usuario set usu_password = '" . $password_new . "'
                            where usu_id = '" . $codigo . "'";
                if (mysqli_query($connection, $update) === true) {
                    $response = array(
                        "codigo" => 109,
                        "mensaje" => "Contraseña actualizada correctamente"
                    );
                } else {
                    $response = array(
                        "codigo" => 110,
                        "mensaje" => "Error al actualizar contraseña"
                    );
                }
            } else {
                $response = array(
                    "codigo" => 113,
                    "mensaje" => "La contraseña actual es incorrecta"
                );
            }

            echo json_encode($response);
        }
        actualizar_password($codigo, $password_new, $password_old, $connection);
        break;
}
