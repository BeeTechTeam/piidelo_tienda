<?php
require_once("../../database/connection.php");

/**Recibimos el m&eacute;todo */
$metodo = $_POST["metodo"];

switch ($metodo) {
        /**Función para registrar un pedido en la base de datos */
    case "FinalizarPedido":
        /**Recibimos los par&aacute;metros a trav&eacute;s del m&eacute;todo POST */
        $carrito = $_POST["carrito"];
        $total = $_POST["total"];
        $cliente = $_POST["cliente"];
        $direccion = $_POST["direccion"];
        $tipo = $_POST["tipo"];
        $fecha_programacion  = $_POST["fecha_programacion"];

        /**Funci&oacute;n para insertar el pedido */
        function finalizar_pedido($carrito, $total, $cliente, $direccion, $tipo, $fecha_programacion, $connection)
        {
            $subtotal = round(floatval($total / 1.18), 2, PHP_ROUND_HALF_UP);
            $igv = round(floatval($total - $subtotal), 2, PHP_ROUND_HALF_UP);
            setlocale(LC_ALL, "es_ES");
            date_default_timezone_set("UTC");
            date_default_timezone_set("America/Lima");
            $fecha_solicitud = date("Y-m-d H:i:s");
            if ($tipo === "Express") {
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
                                '" . $fecha_solicitud . "', 
                                    'EN PROCESO', 
                                    '" . str_replace(",", ".", $subtotal) . "', 
                                    '" . str_replace(",", ".", $igv) . "', 
                                    '" . str_replace(",", ".", $total) . "', 
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
                                '" . $fecha_solicitud . "', 
                                    'EN PROCESO', 
                                    '" . str_replace(",", ".", $subtotal) . "', 
                                    '" . str_replace(",", ".", $igv) . "', 
                                    '" . str_replace(",", ".", $total) . "', 
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
                /**Insertamos las líneas del pedido en la base de datos */
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
                                "mensaje" => "Error al actualizar stock"
                            );
                        }
                    } else {
                        $response = array(
                            "codigo" => 108,
                            "mensaje" => "Error al guardar linea de pedido"
                        );
                    }
                }
            } else {
                $response = array(
                    "codigo" => 108,
                    "mensaje" => "Error al guardar pedido"
                );
            }
            echo json_encode($response);
        }

        /**Ejecutamos la funci&oacute;n para el registro del pedido */
        finalizar_pedido($carrito, $total, $cliente, $direccion, $tipo, $fecha_programacion, $connection);
        break;


        /**Función para listar pedidos */
    case "ListarPedidos":
        $codigo = trim($_POST["codigo"]);
        function listar_pedidos($codigo, $connection)
        {
            $select = "select 
                            pe.ped_id 'codigo',
                            pe.ped_fecha_solicitud 'fecha_solicitud',
                            pe.ped_fecha_entregado 'fecha_entregado',
                            pe.ped_estado 'estado',
                            pe.ped_subtotal 'subtotal',
                            pe.ped_igv 'igv',
                            pe.ped_total 'total',
                            pe.ped_tipo 'tipo',
                            pe.ped_fecha_programacion 'fecha_programacion',
                            concat(di.dir_direccion, ' (', di.dir_nombres,  ' Cel.:', di.dir_telefono, ', DNI:', di.dir_dni, ')')  as 'direccion'
                        from pedido pe
                            inner join direccion di on pe.ped_direccion = di.dir_id
                        where pe.ped_cliente = '" . $codigo . "'
                        order by pe.ped_id desc";
            $resultado = mysqli_query($connection, $select);
            $pedidos = [];
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $pedidos[] = array(
                        "codigo" => $row["codigo"],
                        "estado" => $row["estado"],
                        "fecha_solicitud" => $row["fecha_solicitud"],
                        "fecha_entregado" => $row["fecha_entregado"],
                        "fecha_programacion" => $row["fecha_programacion"],
                        "subtotal" => $row["subtotal"],
                        "igv" => $row["igv"],
                        "total" => $row["total"],
                        "tipo" => $row["tipo"],
                        "direccion" => $row["direccion"]
                    );
                }
                $resultado->close();
            } else {
                $pedidos = [];
            }
            echo json_encode($pedidos);
        }

        /**Ejecutamos la función para listar los pedidos */
        listar_pedidos($codigo, $connection);
        break;

        /**Función para leer el detalle de un pedido */
    case "LeerPedido":
        $pedido = trim($_POST["codigo"]);

        function leer_pedido($pedido, $connection)
        {
            $select = "select 
                            lp.lp_id 'codigo',
                            p.prod_id 'codigo_producto',
                            p.prod_nombre 'producto',
                            p.prod_stock 'stock', 
                            p.prod_foto 'foto', 
                            lp.lp_cantidad 'cantidad', 
                            lp.lp_precio 'precio', 
                            lp.lp_subtotal 'subtotal'
                        from linea_de_pedido lp 
                        inner join producto p on lp.lp_producto = p.prod_id
                        inner join pedido pe on lp.lp_pedido = pe.ped_id
                        where lp.lp_pedido = '" . $pedido . "'";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $lineas[] = array(
                        "codigo" => $row["codigo"],
                        "codigo_producto" => $row["codigo_producto"],
                        "producto" => utf8_decode($row["producto"]),
                        "stock" => $row["stock"],
                        "foto" => ruta_imagenes . "productos/" . utf8_decode($row["foto"]),
                        "cantidad" => $row["cantidad"],
                        "precio" => $row["precio"],
                        "subtotal" => $row["subtotal"]
                    );
                }
                $resultado->close();
            } else {
                $lineas = [];
            }
            echo json_encode($lineas);
        }

        /**Ejecutamos la función para leer el detalle del pedido */
        leer_pedido($pedido, $connection);
        break;

        /**Función para eliminar un pedido */
    case "EliminarPedido":

        /**Recibimos los datos */
        $codigo = trim($_POST["codigo"]);

        /**Eliminar pedido */
        function eliminar_pedido($codigo, $connection)
        {
            $delete = "update pedido set ped_estado = 'ELIMINADO' where ped_id = '" . $codigo . "'";
            if (mysqli_query($connection, $delete) === true) {
                $response = array(
                    "codigo" => 111,
                    "mensaje" => "Pedido eliminado correctamente"
                );
            } else {
                $response = array(
                    "codigo" => 112,
                    "mensaje" => "Error al eliminar pedido"
                );
            }
            echo json_encode($response);
        }

        eliminar_pedido($codigo, $connection);
        break;
}
