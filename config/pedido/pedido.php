<?php
require_once("../../database/connection.php");
require 'vendor/autoload.php';
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
        $fecha_programacion = $_POST["fecha_programacion"];
        $observacion = $_POST["informacion"];
        $comprobante = $_POST["comprobante"];

        /**Funci&oacute;n para insertar el pedido */
        function finalizar_pedido($carrito, $total, $cliente, $direccion, $tipo, $fecha_programacion, $observacion, $comprobante, $connection)
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
                                ped_tipo,
                                ped_observacion,
                                ped_comprobante
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
                                    '" . $observacion . "',
                                    '" . $comprobante . "'
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
                                ped_fecha_programacion,
                                ped_observacion,
                                ped_comprobante
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
                                    '" . $fecha_programacion . "',
                                    '" . $observacion . "',
                                    '" . $comprobante . "'
                            )";
            }

            if (mysqli_query($connection, $insert) === true) {
                $select = "select max(ped_id) as pedido from pedido";
                $resultado = mysqli_query($connection, $select);
                while ($row = $resultado->fetch_assoc()) {
                    /**Traemos el pedido creado */
                    $pedido = trim($row["pedido"]);
                }
                $resultado->close();

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
                            /**Al finalizar el pedido se tiene que enviar el resumen al correo */
                            /**Primero traemos el correo del cliente */
                            $select = "select usu_usuario email from usuario where usu_cliente = '" . $cliente . "'";
                            $resultado = mysqli_query($connection, $select);
                            $correo = "";
                            while ($row = $resultado->fetch_assoc()) {
                                /**Guardamos el email en una variable */
                                $correo = trim($row["email"]);
                            }

                            /**Luego, traemos la dirección asignada para el pedido */
                            $select = "select * from direccion where dir_id = '" . $direccion . "'";
                            $resultado = mysqli_query($connection, $select);
                            $nombres = "";
                            $dni = "";
                            $telefono = "";
                            $direccion_completa = "";
                            $interior = "";
                            while ($row = $resultado->fetch_assoc()) {
                                /**Traemos el pedido creado */
                                $nombres = trim($row["dir_nombres"]);
                                $dni = trim($row["dir_dni"]);
                                $telefono = trim($row["dir_telefono"]);
                                $direccion_completa = trim($row["dir_direccion"]);
                                $interior = trim($row["dir_interior"]);
                            }
                            $resultado->close();

                            /**Llenamos la lista de los productos */
                            $productos = "";
                            for ($i = 0; $i < count($carrito); $i++) {
                                $subtotal = floatval($carrito[$i]["cantidad"] * $carrito[$i]["precio"]);
                                $productos .=
                                    "
                                    <div style='padding: 5px; border-bottom: 1px solid #e5e5e5; width: 50%; margin: auto;'> 
                                        <img src='" . $carrito[$i]["producto"]["prod_foto"] . "' style='width: 100px;' alt='" . $carrito[$i]["producto"]["prod_nombre"] . "' title='" . $carrito[$i]["producto"]["prod_nombre"] . "'>
                                        <p style='font-family: Quicksand; margin: unset;'>Producto: " . $carrito[$i]["producto"]["prod_nombre"] . "</p>
                                        <p style='font-family: Quicksand; margin: unset;'>Cantidad: " . $carrito[$i]["cantidad"] . "</p>
                                        <p style='font-family: Quicksand; margin: unset;'>Precio: " . $carrito[$i]["precio"] . "</p>
                                        <p style='font-family: Quicksand; margin: unset;'>Subtotal: S/" . $subtotal . "</p>
                                    </div>
                                    ";
                            }

                            $htmlContent = "
                            <html lang='en'>
                                <head>
                                    <meta charset='UTF-8'>
                                    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                    <title>Resumen de pedido</title>
                                    <style>
                                        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap');
                                    </style>
                                </head>
            
                                <body>
                                    <div style='text-align: center;'>
                                        <h1 style='font-family: Quicksand;'>RESUMEN DE PEDIDO DE <a href='https://www.piidelo.com'>piidelo.com</a> </h1>
                                        <img src='https://www.piidelo.com/image/logo.png' alt='Piidelo.com' title='Piidelo.com' width='200px'>
                                        <h3 style='font-family: Quicksand;'>Tu pedido ha sido recibido exitosamente y estaremos atendiéndolo lo antes posible.</h3>
                                        <h3 style='font-family: Quicksand;'>Lista de productos</h3>
                                        {$productos}
                                        <p style='font-family: Quicksand;'>TOTAL: <b>S/{$total}</b></p>
                                        <div style='padding: 5px; border-bottom: 1px solid #e5e5e5; border-top: 1px solid #e5e5e5; width: 50%; margin: auto;'> 
                                            <h3 style='font-family: Quicksand;'>Dirección de entrega</h3>
                                            <p style='font-family: Quicksand; margin: unset;'>Nombres: " . $nombres . "</p>
                                            <p style='font-family: Quicksand; margin: unset;'>DNI: " . $dni . "</p>
                                            <p style='font-family: Quicksand; margin: unset;'>Teléfono: " . $telefono . "</p>
                                            <p style='font-family: Quicksand; margin: unset;'>Dirección: " . $direccion_completa . "</p>
                                            <p style='font-family: Quicksand; margin: unset;'>Interior: " . $interior . "</p>
                                            <p style='font-family: Quicksand;'>Si esta no es su dirección o hay algún error por favor escríbenos a este correo o al 922944350, muchas gracias por tu compra.</p>
                                        </div>
                                    </div>
                                </body>
            
                            </html>";

                            $email = new \SendGrid\Mail\Mail();
                            $email->setFrom("hola@piidelo.com", "Piidelo.com");
                            $email->setSubject("RESUMEN DE PEDIDO - PIIDELO.COM");
                            $email->addTo($correo, $correo);
                            $email->addContent("text/html", $htmlContent);
                            $sendgrid = new \SendGrid("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");
                            try {
                                $response_grid = $sendgrid->send($email);
                                $codigo_response_grid = $response_grid->statusCode();
                            } catch (Exception $e) {
                                echo 'Caught exception: ' . $e->getMessage() . "\n";
                            }
                            if ($codigo_response_grid === 202) {
                                $response = array(
                                    "codigo" => 107,
                                    "mensaje" => "Su pedido fue registrado satisfactoriamente. Se le ha enviado un resumen de su pedido a su correo"
                                );
                            } else {
                                $response = array(
                                    "codigo" => 107,
                                    "mensaje" => "Su pedido fue registrado satisfactoriamente"
                                );
                            }
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
                    "mensaje" => "Error al guardar pedido" . $connection->error
                );
            }
            echo json_encode($response);
        }

        /**Ejecutamos la funci&oacute;n para el registro del pedido */
        finalizar_pedido($carrito, $total, $cliente, $direccion, $tipo, $fecha_programacion, $observacion, $comprobante, $connection);
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
