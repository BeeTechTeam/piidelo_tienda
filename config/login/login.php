<?php
require_once("../connection.php");
$metodo = $_POST["metodo"];
switch ($metodo) {
    case "Login":
        /**Recibimos los parámetros a través del método POST */
        $documento  = trim($_POST["documento"]);
        $password   = trim($_POST["password"]);

        /**Función para el login */
        function login($documento, $password)
        {
            /**Verificamos si el distribuidor se logea con su código de 4 dígitos */
            if (strlen($documento) === 4) {
                $select = "select * from usuario u
                inner join distribuidor d on u.usu_id = d.dis_usu_id
                where u.usu_documento = '" . trim($documento) . "' or d.dis_cod = '" . trim($documento)  . "' and u.usu_password = BINARY '" . trim($password) . "'";
            }

            /**Verificamos si el distribuidor se logea con su RUC ó DNI */
            else {
                $select = "select * from usuario where usu_documento = '" . trim($documento) . "' and usu_password = BINARY '" . trim($password) . "'";
            }
            $resultado = $_SESSION["Connection"]->query($select);

            /**Verificamos que existan las credenciales ingresadas */
            if ($resultado->num_rows == 1) {
                while ($row = $resultado->fetch_assoc()) {
                    /**Cuando el usuario fue eliminado */
                    if (trim($row["usu_estado"]) == "ELIMINADO") {
                        $_SESSION["LoginID"] = null;
                        $_SESSION["LoginFuncion"] = null;
                        $_SESSION["LoginNombre"] = null;
                        $mensaje = "ERROR: Usuario eliminado";
                    }

                    /**Cuando el usuario es un bodeguero */
                    else if (trim($row["usu_funcion"]) == "BODEGUERO") {
                        $_SESSION["LoginID"] = null;
                        $_SESSION["LoginFuncion"] = null;
                        $_SESSION["LoginNombre"] = null;
                        $mensaje = "ERROR: Los usuarios de las tiendas sólo tienen acceso desde la aplicación móvil";
                    }

                    /**Cuando el usuario es el webmaster */
                    else if (trim($row["usu_funcion"]) == "WEBMASTER") {
                        $_SESSION["LoginID"] = null;
                        $_SESSION["LoginFuncion"] = null;
                        $_SESSION["LoginNombre"] = null;
                        $mensaje = "ERROR: Sólo pueden ingresar los distribuidores";
                    }

                    /**Cuando el usuario es fabricante */
                    else if (trim($row["usu_funcion"]) == "FABRICANTE") {
                        $_SESSION["LoginID"] = null;
                        $_SESSION["LoginFuncion"] = null;
                        $_SESSION["LoginNombre"] = null;
                        $mensaje = "ERROR: Sólo pueden ingresar los distribuidores";
                    }

                    /**Login exitoso */
                    else {
                        $_SESSION["LoginSession"] = session_name();
                        $_SESSION["LoginID"] = trim($row["usu_id"]);
                        $_SESSION["LoginFuncion"] = trim($row["usu_funcion"]);
                        $_SESSION["LoginAvatar"] = trim($row["usu_avatar"]);
                        $_SESSION["LoginNombre"] = trim($row["usu_nombre"]);
                        $_SESSION["LoginDocumento"] = trim($row["usu_documento"]);
                        $mensaje = "¡Bienvenido " . $_SESSION["LoginNombre"] . "!";
                    }
                }
                $mensaje_bienvenida = $mensaje;
            }

            /**Cuando las credenciales son incorrectas */
            else {
                $_SESSION["LoginID"] = null;
                $_SESSION["LoginFuncion"] = null;
                $_SESSION["LoginNombre"] = null;
                $mensaje_bienvenida = "ERROR: Datos de acceso incorrectos";
            }

            /**Array de bienvenida */
            $array = array(
                "mensaje_bienvenida" => $mensaje_bienvenida,
                "usuario_id" => $_SESSION["LoginID"],
                "usuario_funcion" => $_SESSION["LoginFuncion"],
                "usuario_nombre" => $_SESSION["LoginNombre"]
            );

            echo json_encode($array);
            $resultado->close();
        }

        /**Ejecutamos la función para el login */
        login($documento, $password);
        break;
}
