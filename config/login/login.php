<?php
require_once("../../database/connection.php");
/**Creamos la conexión */
$connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");

/**Recibimos los datos ingresados */
$usuario = trim($_POST["usuario"]);
$password = trim($_POST["password"]);

/**Ruta de imagenes */
$ruta = "http://localhost/piidelo/piidelo_backoffice/images/usuarios/";
// $ruta = "https://ecommerce.izipedidos.pe/backoffice/images/usuarios/";

/**Ejecutamos la función de inicio de sesión con los parámetros recibidos */
signin($usuario, $password, $ruta, $connection);

/**Función de inicio de sesión */
function signin($usuario, $password, $ruta, $connection)
{
    /**Respuesta */
    $response = array();
    /**Buscamos el documento ingresado */
    $select_usuario = "select * from usuario
        where usu_usuario = '" . $usuario . "' and usu_estado = 'ACTIVO'";
    $result_usuario = mysqli_query($connection, $select_usuario);
    if ($result_usuario->num_rows < 1) {
        $response = array(
            "codigo" => 100,
            "usuario" => [],
            "empresa" => []
        );
        echo json_encode($response);
        return;
    }

    /**Verificamos que la contraseña sea la correcta */
    $select_usuario = "select * from usuario
        where usu_usuario = '" . $usuario . "' and usu_password = '" . $password . "' and usu_estado = 'ACTIVO'";
    $result_usuario = mysqli_query($connection, $select_usuario);
    if ($result_usuario->num_rows < 1) {
        $response = array(
            "codigo" => 101,
            "usuario" => [],
            "empresa" => []
        );
        echo json_encode($response);
        return;
    }

    /**Determinamos la función y el estado del usuario */
    while ($row = $result_usuario->fetch_assoc()) {
        $funcion = $row["usu_funcion"];
        $estado = $row["usu_estado"];
        $user = array(
            "usu_id" => $row["usu_id"],
            "usu_nombres" => $row["usu_nombres"],
            "usu_apellidos" => $row["usu_apellidos"],
            "usu_usuario" => $row["usu_usuario"],
            "usu_password" => $row["usu_password"],
            "usu_foto" => $ruta . $row["usu_foto"],
            "usu_estado" => $estado,
            "usu_funcion" => $funcion,
        );
    }

    /**Usuario eliminado */
    if ($estado === "ELIMINADO") {
        $response = array(
            "codigo" => 102,
            "usuario" => [],
            "empresa" => []
        );
        echo json_encode($response);
        return;
    }

    /**Usuario webmaster */
    if ($funcion === "WEBMASTER") {
        $response = array(
            "codigo" => 105,
            "usuario" => [],
            "empresa" => []
        );
        echo json_encode($response);
        return;
    }

    /**Usuario proveedor */
    if ($funcion === "PROVEEDOR") {
        $response = array(
            "codigo" => 105,
            "usuario" => [],
            "empresa" => []
        );
        echo json_encode($response);
        return;
    }


    /**Usuario de cliente */
    if ($funcion === "CLIENTE") {
        $select_cliente = "select
            c.cli_id as 'codigo',
            c.cli_ruc as 'ruc',
            c.cli_razon_social as 'razon_social',
            c.cli_telefono as 'telefono',
            c.cli_email as 'email',
            c.cli_estado as 'estado'
                from cliente c
                    inner join usuario u on c.cli_id = u.usu_cliente
                    where 
                        u.usu_usuario = '" . $usuario . "' and 
                        u.usu_password = '" . $password . "' and 
                        u.usu_estado = 'ACTIVO' and
                        c.cli_estado = 'ACTIVO'";
        $result_cliente = mysqli_query($connection, $select_cliente);
        if ($result_cliente->num_rows > 0) {
            while ($row = $result_cliente->fetch_assoc()) {
                $cliente = array(
                    "codigo" => trim($row["codigo"]),
                    "ruc" => trim($row["ruc"]),
                    "razon_social" => trim($row["razon_social"]),
                    "telefono" => trim($row["telefono"]),
                    "email" => trim($row["email"]),
                    "estado" => trim($row["estado"]),
                );
            }
            $response = array(
                "codigo" => 103,
                "usuario" => $user,
                "cliente" => $cliente
            );
            echo json_encode($response);
        }
        return;
    }


    /**Usuario no autorizado */
    $response = array(
        "codigo" => 105,
        "usuario" => [],
        "empresa" => []
    );
    echo json_encode($response);
}
