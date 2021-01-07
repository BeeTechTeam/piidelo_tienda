<?php
require_once("../../database/connection.php");

/**Creamos la conexión */
$connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");

$metodo = $_POST["metodo"];
switch ($metodo) {
    case "Signup":
        /**Recibimos los parámetros a través del método POST */
        $ruc_dni  = trim($_POST["ruc_dni"]);
        $razon_social_nombres   = trim($_POST["razon_social_nombres"]);
        $telefono   = trim($_POST["telefono"]);
        $email   = trim($_POST["email"]);
        $password   = trim($_POST["password"]);

        /**Función para el login */
        function signin($ruc_dni, $razon_social_nombres, $telefono, $email, $password, $connection)
        {
            $select = "select * from cliente where cli_ruc = '" . trim($ruc_dni) . "'  and cli_estado = 'ACTIVO'";
            $result = mysqli_query($connection, $select);
            if ($result->num_rows > 0) {
                $response = array(
                    "codigo" => 106,
                    "mensaje" => "Ya existe el cliente"
                );
                echo json_encode($response);
                $result->close();
            } else {
                $insert = "insert into cliente(
                        cli_ruc,
                        cli_razon_social,
                        cli_telefono,
                        cli_email,
                        cli_estado) 
                        values(
                            '" . trim($ruc_dni) . "',
                            '" . trim($razon_social_nombres) . "',
                            '" . trim($telefono) . "',
                            '" . trim($email) . "',
                            '" . trim("ACTIVO") . "'
                            )";
                if (mysqli_query($connection, $insert) === true) {
                    $select = "select * from cliente order by cli_id desc limit 1";
                    $result =  mysqli_query($connection, $select);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $cliente = $row["cli_id"];
                        }
                    }
                    // $response = array(
                    //     "codigo" => 107,
                    //     "mensaje" => "Cliente creado correctamente",
                    //     "cliente" => $cliente
                    // );
                    // echo json_encode($response);
                    crear_usuario($cliente, $email, $password, $razon_social_nombres,  $connection);
                    // $result->close();
                } else {
                    $response = array(
                        "codigo" => 108,
                        "mensaje" => "Error al crear cliente"
                    );
                    echo json_encode($response);
                    $result->close();
                }
            }
        }

        function crear_usuario($cliente, $email, $password, $razon_social_nombres,  $connection)
        {
            $select = "select * from usuario where usu_usuario = '" . trim($cliente) . "' and usu_estado = 'ACTIVO'";
            $result = mysqli_query($connection, $select);
            if ($result->num_rows > 0) {
                $response = array(
                    "codigo" => 106,
                    "mensaje" => "Ya existe el usuario"
                );
                echo json_encode($response);
                $result->close();
            } else {
                $insert = "insert into usuario(
                    usu_nombres, 
                    usu_apellidos,
                    usu_usuario,
                    usu_password,
                    usu_estado,
                    usu_funcion,
                    usu_cliente) 
                    values(
                        '" . trim($razon_social_nombres) . "',
                        '" . trim($razon_social_nombres) . "',
                        '" . trim($email) . "',
                        '" . trim($password) . "',
                        'ACTIVO',
                        'CLIENTE',
                        '" . trim($cliente) . "'
                        )";
                if (mysqli_query($connection, $insert) === true) {
                    $response = array(
                        "codigo" => 107,
                        "mensaje" => "Usuario creado correctamente"
                    );
                    echo json_encode($response);
                    $result->close();
                } else {
                    $response = array(
                        "codigo" => 108,
                        "mensaje" => "Error al crear usuario"
                    );
                    echo json_encode($response);
                    $result->close();
                }
            }
        }
        /**Ejecutamos la función para el signin */
        signin($ruc_dni, $razon_social_nombres, $telefono, $email, $password, $connection);
        break;
}
