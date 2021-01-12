<?php
require_once("../../database/connection.php");

/**Creamos la conexión */
$connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");

$metodo = $_POST["metodo"];
switch ($metodo) {
        /**Función para registra al usuario en la base de datos */
    case "Signup":
        /**Recibimos los par&aacute;metros a trav&eacute;s del m&eacute;todo POST */
        $ruc_dni = trim($_POST["ruc_dni"]);
        $razon_social_nombres = trim($_POST["razon_social_nombres"]);
        $telefono = trim($_POST["telefono"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        /**Función para el login */
        function signup($ruc_dni, $razon_social_nombres, $telefono, $email, $password, $connection)
        {

            $select = "select cli_id from cliente where cli_ruc = '" . trim($ruc_dni) . "'  and cli_estado = 'ACTIVO'";
            $result = mysqli_query($connection, $select);
            $response = [];
            if ($result->num_rows > 0) {
                $response = array(
                    "codigo" => 106,
                    "mensaje" => "Ya existe el cliente"
                );
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
                    $select = "select cli_id from cliente order by cli_id desc limit 1";
                    $result =  mysqli_query($connection, $select);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $cliente = $row["cli_id"];
                        }
                    }
                    $result->close();

                    $select = "select usu_id from usuario where usu_usuario = '" . trim($email) . "' and usu_estado = 'ACTIVO'";
                    $result = mysqli_query($connection, $select);
                    if ($result->num_rows > 0) {
                        $delete = "delete from cliente where cli_id = '" . $cliente . "'";
                        if (mysqli_query($connection, $delete) === true) {
                            $response = array(
                                "codigo" => 106,
                                "mensaje" => "El email ingresado ya se encuentra registrado"
                            );
                            $result->close();
                        }
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
                                "mensaje" => "Cuenta creada correctamente, ya puedes iniciar sesión"
                            );
                        } else {
                            $delete = "delete from cliente where cli_id = '" . $cliente . "'";
                            if (mysqli_query($connection, $delete) === true) {
                                $response = array(
                                    "codigo" => 108,
                                    "mensaje" => "Error al crear cuenta, intente más tarde"
                                );
                            }
                        }
                    }
                } else {
                    $response = array(
                        "codigo" => 108,
                        "mensaje" => "Error al crear cliente"
                    );
                }
            }
            echo json_encode($response);
        }
        /**Ejecutamos la función para el signup */
        signup($ruc_dni, $razon_social_nombres, $telefono, $email, $password, $connection);
        break;
}
