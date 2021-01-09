<?php
require_once("../../database/connection.php");

/**Creamos la conexión */
$connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");

/**Recibimos el método */
$metodo = $_POST["metodo"];

switch ($metodo) {
    case "FinalizarPedido":
        /**Recibimos los parámetros a través del método POST */
        $carrito  = $_POST["carrito"];
        $total  = $_POST["total"];
        $cliente  = $_POST["cliente"];
        $direccion  = $_POST["direccion"];
        $tipo  = $_POST["tipo"];
        $fecha_programacion  = $_POST["fecha_programacion"];

        /**Función para insertar el pedido */
        function insertar_pedido($carrito, $total, $cliente, $direccion, $tipo, $fecha_programacion, $connection)
        {
            $subtotal = round(floatval($total / 1.18), 2, PHP_ROUND_HALF_UP);
            $igv = round(floatval($total - $subtotal), 2, PHP_ROUND_HALF_UP);
            if ($tipo === "express") {
                $insert = "insert into pedido(
                                ped_fecha_solicitud,
                                ped_estado,
                                ped_subtotal,
                                ped_igv,
                                ped_total,
                                ped_cliente,
                                ped_direccion,
                                ped_tipo
                            ) 
                            values(
                                '" . trim(date("Y-m-d H:m:s")) . "', 
                                    'EN PROCESO', 
                                    '" . $subtotal . "', 
                                    '" . $igv . "', 
                                    '" . $total . "', 
                                    '" . $cliente . "', 
                                    '" . $direccion . "', 
                                    '" . $tipo . "'
                            )";
            } else {
                $insert = "insert into pedido(
                                ped_fecha_solicitud,
                                ped_estado,
                                ped_subtotal,
                                ped_igv,
                                ped_total,
                                ped_cliente,
                                ped_direccion,
                                ped_tipo,
                                ped_fecha_programacion
                            ) 
                            values(
                                '" . trim(date("Y-m-d H:m:s")) . "', 
                                    'EN PROCESO', 
                                    '" . $subtotal . "', 
                                    '" . $igv . "', 
                                    '" . $total . "', 
                                    '" . $cliente . "', 
                                    '" . $direccion . "', 
                                    '" . $tipo . "',
                                    '" . $fecha_programacion . "'
                            )";
            }

            if (mysqli_query($connection, $insert) === true) {
                $select = "select max(ped_id) as pedido from pedido";
                $resultado = mysqli_query($connection, $select);
                while ($row = $resultado->fetch_assoc()) {
                    /**Traemos el pedido creado */
                    $pedido = trim($row["pedido"]);
                }
                for ($i = 0; $i < count($carrito); $i++) {
                    $subtotal = floatval($carrito[$i]["cantidad"] * $carrito[$i]["precio"]);
                    $insert_linea = "insert into linea_de_pedido(
                                    lp_cantidad,
                                    lp_precio,
                                    lp_subtotal,
                                    lp_pedido,
                                    lp_producto
                                )
                                values(
                                    '" . trim($carrito[$i]["cantidad"]) . "',
                                    '" . trim($carrito[$i]["precio"]) . "',
                                    '" . trim($subtotal) . "',
                                    '" . trim($pedido) . "',
                                    '" . trim($carrito[$i]["producto"]["prod_id"]) . "'
                                )";
                    if (mysqli_query($connection, $insert_linea) === true) {
                        $update = "update producto set prod_stock = prod_stock - " . $carrito[$i]["cantidad"] . " where prod_id = " . $carrito[$i]["producto"]["prod_id"] . "";
                        if (mysqli_query($connection, $update) === true) {
                            $response = array(
                                "codigo" => 107,
                                "mensaje" => "Su pedido fue registrado satisfactoriamente"
                            );
                        } else {
                            $response = array(
                                "codigo" => 108,
                                "mensaje" => "Error al actualizar stock" . $update
                            );
                            $registrado = false;
                        }
                    } else {
                        $response = array(
                            "codigo" => 108,
                            "mensaje" => "Error al guardar linea de pedido" . $insert_linea
                        );
                    }
                }
            } else {
                $response = array(
                    "codigo" => 108,
                    "mensaje" => "Error al guardar pedido" . $insert
                );
            }
            echo json_encode($response);
        }


        /**Ejecutamos la función para el registro del pedido */
        insertar_pedido($carrito, $total, $cliente, $direccion, $tipo, $fecha_programacion, $connection);
        break;
}
