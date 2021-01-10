<?php
require_once("../../database/connection.php");
/**Creamos la conexi&oacute;n */
$connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");

/**Recibimos el m&eacute;todo */
$metodo = $_POST["metodo"];

switch ($metodo) {
    case "AgregarDireccion":
        $nombres = utf8_encode(trim($_POST["nombres"]));
        $dni = trim($_POST["dni"]);
        $telefono = trim($_POST["telefono"]);
        $direccion = utf8_encode(trim($_POST["direccion"]));
        $latitud = trim($_POST["latitud"]);
        $longitud = trim($_POST["longitud"]);
        $distrito = trim($_POST["distrito"]);
        $cliente = trim($_POST["cliente"]);

        function crear_direccion($nombres, $dni, $telefono, $direccion, $latitud, $longitud, $distrito, $cliente, $connection)
        {
            $insert = "insert into direccion(
                dir_nombres,
                dir_dni,
                dir_telefono,
                dir_direccion,
                dir_latitud,
                dir_longitud,
                dir_estado,
                dir_distrito,
                dir_cliente) 
                values(
                    '" . $nombres . "',
                    '" . $dni . "',
                    '" . $telefono . "',
                    '" . $direccion . "',
                    '" . $latitud . "',
                    '" . $longitud . "',
                    'ACTIVA',
                    '" . $distrito . "',
                    '" . $cliente . "'
                    )";
            if (mysqli_query($connection, $insert) === true) {
                $response = array(
                    "codigo" => 107,
                    "mensaje" => "Direcci&oacute;n agregada correctamente"
                );
            } else {
                $response = array(
                    "codigo" => 108,
                    "mensaje" => "Error al agregar direcci&oacute;n"
                );
            }
            echo  json_encode($response);
        }

        crear_direccion($nombres, $dni, $telefono, $direccion, $latitud, $longitud, $distrito, $cliente, $connection);
        break;

    case "ListarDirecciones":
        $codigo = trim($_POST["codigo"]);

        function listar_direcciones($codigo, $connection)
        {
            $select = "select 
                            dir.*,  
                            dis.dis_nombre 'dir_distrito',
                            dis.dis_id 'dir_distrito_id',
                            pro.provi_nombre 'dir_provincia',
                            pro.provi_id 'dir_provincia_id',
                            dep.dep_nombre 'dir_departamento',
                            dep.dep_id 'dir_departamento_id',
                            dis.dis_delivery 'dir_envio'
                        from direccion dir 
                            inner join cliente c on dir.dir_cliente = c.cli_id
                            inner join distrito dis on dir.dir_distrito = dis.dis_id
                            inner join provincia pro on dis.dis_provincia = pro.provi_id
                            inner join departamento dep on pro.provi_departamento = dep.dep_id
                        where dir_cliente = '" . $codigo . "' and dir_estado = 'ACTIVA'";
            $result = mysqli_query($connection, $select);
            $direcciones = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $direcciones[] = array(
                        "codigo" => $row["dir_id"],
                        "nombres" => utf8_decode($row["dir_nombres"]),
                        "dni" => $row["dir_dni"],
                        "telefono" => $row["dir_telefono"],
                        "direccion" => utf8_decode($row["dir_direccion"]),
                        "latitud" => $row["dir_latitud"],
                        "longitud" => $row["dir_longitud"],
                        "distrito" => utf8_decode($row["dir_distrito"]),
                        "distrito_id" => $row["dir_distrito_id"],
                        "provincia" => utf8_decode($row["dir_provincia"]),
                        "provincia_id" => $row["dir_provincia_id"],
                        "departamento" => utf8_decode($row["dir_departamento"]),
                        "departamento_id" => $row["dir_departamento_id"],
                        "envio" => $row["dir_envio"]
                    );
                }
                $result->close();
            } else {
                $direcciones = [];
            }
            echo json_encode($direcciones);
        }

        listar_direcciones($codigo, $connection);
        break;
    case "LeerDireccion":
        $codigo = trim($_POST["codigo"]);

        function listar_direccion($codigo, $connection)
        {
            $select = "select 
                                dir.*,  
                                dis.dis_nombre 'dir_distrito',
                                pro.provi_nombre 'dir_provincia',
                                dep.dep_nombre 'dir_departamento',
                                dis.dis_delivery 'dir_envio'
                            from direccion dir 
                                inner join distrito dis on dir.dir_distrito = dis.dis_id
                                inner join provincia pro on dis.dis_provincia = pro.provi_id
                                inner join departamento dep on pro.provi_departamento = dep.dep_id
                            where dir_id = '" . $codigo . "'";
            $result = mysqli_query($connection, $select);
            $direccion = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $direccion = array(
                        "codigo" => $row["dir_id"],
                        "nombres" => utf8_decode($row["dir_nombres"]),
                        "dni" => $row["dir_dni"],
                        "telefono" => $row["dir_telefono"],
                        "direccion" => utf8_decode($row["dir_direccion"]),
                        "latitud" => $row["dir_latitud"],
                        "longitud" => $row["dir_longitud"],
                        "distrito" => utf8_decode($row["dir_distrito"]),
                        "provincia" => utf8_decode($row["dir_provincia"]),
                        "departamento" => utf8_decode($row["dir_departamento"]),
                        "envio" => $row["dir_envio"]
                    );
                }
                $result->close();
            } else {
                $direccion = [];
            }
            echo json_encode($direccion);
        }

        listar_direccion($codigo, $connection);
        break;

    case "EditarDireccion":
        $codigo = trim($_POST["codigo"]);
        $nombres = utf8_encode(trim($_POST["nombres"]));
        $dni = trim($_POST["dni"]);
        $telefono = trim($_POST["telefono"]);
        $direccion = utf8_encode(trim($_POST["direccion"]));
        $latitud = trim($_POST["latitud"]);
        $longitud = trim($_POST["longitud"]);
        $distrito = trim($_POST["distrito"]);
        $cliente = trim($_POST["cliente"]);

        function editar($codigo, $nombres, $dni, $telefono, $direccion, $latitud, $longitud, $distrito, $cliente, $connection)
        {
            $delete = "update direccion set 
                            dir_nombres = '" . $nombres . "',
                            dir_dni = '" . $dni . "',
                            dir_telefono = '" . $telefono . "',
                            dir_direccion = '" . $direccion . "',
                            dir_latitud = '" . $latitud . "',
                            dir_longitud = '" . $longitud . "',
                            dir_distrito = '" . $distrito . "',
                            dir_cliente = '" . $cliente . "'
                        where dir_id = '" . $codigo . "'";
            if (mysqli_query($connection, $delete) === true) {
                $response = array(
                    "codigo" => 111,
                    "mensaje" => "Dirección editada correctamente"
                );
            } else {
                $response = array(
                    "codigo" => 112,
                    "mensaje" => "Error al editar dirección"
                );
            }

            echo json_encode($response);
        }

        editar($codigo, $nombres, $dni, $telefono, $direccion, $latitud, $longitud, $distrito, $cliente, $connection);
        break;


    case "EliminarDireccion":

        $codigo = trim($_POST["codigo"]);

        function eliminar_direccion($codigo, $connection)
        {
            $delete = "update direccion set dir_estado = 'ELIMINADA' where dir_id = '" . $codigo . "'";
            if (mysqli_query($connection, $delete) === true) {
                $response = array(
                    "codigo" => 111,
                    "mensaje" => "Dirección eliminado correctamente"
                );
            } else {
                $response = array(
                    "codigo" => 112,
                    "mensaje" => "Error al eliminar dirección"
                );
            }
            echo json_encode($response);
        }

        eliminar_direccion($codigo, $connection);
        break;
}
