<?php
require_once("../connection.php");
$metodo = $_POST["metodo"];
switch ($metodo) {
    case "FinalizarPedido":
        /**Recibimos los parámetros a través del método POST */
        $pedido  = $_POST["pedido"];
        $distribuidor  = trim($_POST["distribuidor"]);

        /**Función para insertar el pedido */
        function insertar_pedido($pedido, $distribuidor, $gpfd, $fabricante)
        {
            $total_pedido = 0;
            for ($p = 0; $p < count($pedido); $p++) {
                if ($pedido[$p]["pro_precio_oferta"] != "") {
                    $pro_cantidad       = $pedido[$p]["pro_cantidad"];
                    $pro_precio_compra  = $pedido[$p]["pro_precio_oferta"];
                    $total_pedido += floatval($pro_cantidad * $pro_precio_compra);
                } else {
                    $pro_cantidad       = $pedido[$p]["pro_cantidad"];
                    $pro_precio_compra  = $pedido[$p]["pro_precio_compra"];
                    $total_pedido += $pro_cantidad * $pro_precio_compra;
                }
            }
            $pfd = 0;
            $subtotal = round(floatval($total_pedido / 1.18), 2, PHP_ROUND_HALF_UP);
            $igv = round(floatval($total_pedido - $subtotal), 2, PHP_ROUND_HALF_UP);

            $insert_p = "insert into pedido_fd(
                    pfd_fecha_solicitud, 
                    pfd_estado, 
                    pfd_subtotal, 
                    pfd_igv, 
                    pfd_total, 
                    pfd_forma_pago, 
                    pfd_fab_id, 
                    pfd_dis_id, 
                    pfd_gpfd_id
                ) 
                values(
                   '" . trim(date("Y-m-d")) . "', 
                    '" . trim("EN PROCESO") . "', 
                    '" . str_replace(",", ".", $subtotal) . "', 
                    '" . str_replace(",", ".", $igv) . "', 
                    '" . str_replace(",", ".", $total_pedido) . "', 
                    '" . trim("EFECTIVO") . "', 
                    '" . trim($fabricante) . "', 
                    '" . trim($distribuidor) . "', 
                    '" . trim($gpfd) . "'
                )";

            if ($_SESSION['Connection']->query($insert_p) === true) {
                $select = "select max(pfd_id) as pfd from pedido_fd";
                $resultado = $_SESSION["Connection"]->query($select);
                while ($row = $resultado->fetch_assoc()) {
                    /**Traemos el pedido creado */
                    $pfd = trim($row["pfd"]);
                }
                $precio = 0;
                for ($p = 0; $p < count($pedido); $p++) {
                    if ($pedido[$p]["pro_precio_oferta"] != "") {
                        $subtotal = floatval($pedido[$p]["pro_cantidad"] * $pedido[$p]["pro_precio_oferta"]);
                    } else {
                        $subtotal = floatval($pedido[$p]["pro_cantidad"] * $pedido[$p]["pro_precio_compra"]);
                    }

                    if ($pedido[$p]["pro_precio_oferta"] != "") {
                        $precio = $pedido[$p]["pro_precio_oferta"];
                    } else {
                        $precio = $pedido[$p]["pro_precio_compra"];
                    }

                    $insert = "insert into detalle_pedido_fd(
                            dpfd_cantidad,
                            dpfd_precio,
                            dpfd_subtotal,
                            dpfd_ped_id,
                            dpfd_pro_id)
                        values(
                            '" . trim($pedido[$p]["pro_cantidad"]) . "',
                            '" . trim($precio) . "',
                            '" . trim($subtotal) . "',
                            '" . trim($pfd) . "',
                            '" . trim($pedido[$p]["pro_id"]) . "'
                        )";
                    if ($_SESSION['Connection']->query($insert) === true) {
                        reducir_stock($pedido[$p]["pro_id"], $pedido[$p]["pro_cantidad"]);
                    } else {
                        echo  "ERROR: No se pudo insertar el detalle del pedido";
                    }
                }
            } else {
                echo  "ERROR: No se pudo insertar el pedido " . $insert_p;
            }
        }

        /**Función para reducir el stock de los productos */
        function reducir_stock($producto, $cantidad)
        {
            $update = "update producto_fabricante set pf_stock = pf_stock - " . trim($cantidad) . " where pf_pro_id = " . trim($producto) . "";
            if ($_SESSION['Connection']->query($update) === true) {
            } else {
                echo  "ERROR: No se pudo actualizar el stock";
            }
        }

        /**Función para registrar el pedido */
        function finalizar_pedido($pedido, $distribuidor)
        {
            $total_pedido = 0;
            $fabricante_mm = "";
            $pedido_minimo = 0;
            $fabricantes_todos = array();

            /**Recorremos el carrito */
            for ($p = 0; $p < count($pedido); $p++) {

                array_push($fabricantes_todos, $pedido[$p]["pro_fabricante_id"]);
                if ($pedido[$p]["pro_precio_oferta"] != "") {
                    $pro_cantidad       = $pedido[$p]["pro_cantidad"];
                    $pro_precio_compra  = $pedido[$p]["pro_precio_oferta"];
                    $total_pedido += floatval($pro_cantidad * $pro_precio_compra);
                } else {
                    $pro_cantidad       = $pedido[$p]["pro_cantidad"];
                    $pro_precio_compra  = $pedido[$p]["pro_precio_compra"];
                    $total_pedido += floatval($pro_cantidad * $pro_precio_compra);
                }
            }
            /**Eliminamos los fabricantes repetidos */
            $fabricantes_unicos = array_unique($fabricantes_todos);

            /**Verificamos el pedido mínimo */
            $monto_aceptado = false;
            for ($f = 0; $f < count($fabricantes_unicos); $f++) {
                $select = "select 
                                fd.fd_pedido_minimo, 
                                f.fab_razon_social
                            from fabricante_distribuidor fd
                            inner join fabricante f on fd.fd_fab_id = f.fab_id
                            where 
                                fd_fab_id = '" . trim($fabricantes_unicos[$f]) . "' and fd_dis_id = '" . trim($distribuidor) . "'";
                $resultado = $_SESSION['Connection']->query($select);
                if ($resultado->num_rows >= 1) {
                    while ($row = $resultado->fetch_assoc()) {
                        $pedido_minimo = floatval($row["fd_pedido_minimo"]);
                        $fabricante_mm = $row["fab_razon_social"];
                    }
                    if ($total_pedido >= $pedido_minimo) {
                        $monto_aceptado = true;
                    } else {
                        $monto_aceptado = false;
                    }
                    $resultado->close();
                } else {
                    echo "ERROR: No estás relacionado con este fabricante";
                }
            }


            /**Insertamos el grupo del pedido */
            if ($monto_aceptado == true) {
                $insert = "insert into grupo_pedido_fd(gpfd_total, gpfd_dis_id) values(" . trim($total_pedido) . ", " . trim($distribuidor) . ")";
                $gpfd = 0;
                if ($_SESSION['Connection']->query($insert) === true) {
                    $select = "select max(gpfd_id) as gpfd from grupo_pedido_fd";
                    $resultado = $_SESSION["Connection"]->query($select);
                    while ($row = $resultado->fetch_assoc()) {
                        /**Traemos el grupo creado */
                        $gpfd = trim($row["gpfd"]);
                    }
                } else {
                    echo  "ERROR: No se pudo insertar el grupo de pedido";
                }

                if (count($fabricantes_unicos) <= 1) {
                    insertar_pedido($pedido, $distribuidor, $gpfd, $fabricantes_unicos[0]);
                } else {
                    $pedidos = array();
                    for ($f = 0; $f < count($fabricantes_unicos); $f++) {
                        $fab_1 = $fabricantes_unicos[$f];
                        $pedidos[$fab_1] = array();
                    }

                    for ($i = 0; $i < count($pedido); $i++) {
                        $pro_1 = $pedido[$i]["pro_fabricante_id"];
                        array_push($pedidos[$pro_1], $pedido[$i]);
                    }

                    foreach ($fabricantes_unicos as $fabricante) {
                        $pedido = $pedidos[$fabricante];
                        /**Insertar pedido */
                        insertar_pedido($pedido, $distribuidor, $gpfd, $fabricante);
                    }
                }
            } else {
                echo "ERROR: El monto mínimo para realizar el pedido a " . $fabricante_mm . " es S/" . $pedido_minimo;
            }
        }

        /**Ejecutamos la función para el registro del pedido */
        finalizar_pedido($pedido, $distribuidor);
        break;

    case "LeerPedidos":
        /**Recibimos al distribuidor */
        $distribuidor  = trim($_POST["distribuidor"]);

        /**Función para leer los pedidos de un distribuidor */
        function leer_pedidos($distribuidor)
        {
            $select = "select 
                            gpf.gpfd_id as 'codigo', 
                            sum(p.pfd_total) as 'total', 
                            p.pfd_fecha_solicitud as 'fecha',
                            p.pfd_estado as 'estado'
                        from grupo_pedido_fd gpf 
                        inner join pedido_fd p on gpf.gpfd_id = p.pfd_gpfd_id
                        where 
                            gpf.gpfd_dis_id = " . trim($distribuidor) . "
                        group by gpf.gpfd_id
                        order by gpf.gpfd_id desc";
            $resultado = $_SESSION["Connection"]->query($select);
            $pedidos = array();
            while ($row = $resultado->fetch_assoc()) {
                /**Guardamos los pedidos */
                $pedidos[] = array(
                    "codigo"    => trim($row["codigo"]),
                    "total"     => trim($row["total"]),
                    "fecha"     => trim($row["fecha"]),
                    "estado"    => trim($row["estado"])
                );
            }
            echo json_encode($pedidos);
            $resultado->close();
        }

        /**Ejecutamos la función */
        leer_pedidos($distribuidor);
        break;

    case "LeerPedido":
        /**Recibimos el pedido */
        $pedido  = $_POST["pedido"];

        /**Función para leer un pedido */
        function leer_pedido($pedido)
        {
            $select = "select 
                        pro.pro_id as 'codigo',
                        pro.pro_foto as 'foto', 
                        pro.pro_nombre as 'producto', 
                        pro.pro_marca as 'marca',
                        dp.dpfd_cantidad as 'cantidad', 
                        dp.dpfd_precio as 'precio', 
                        gp.gpfd_total as 'total',
                        f.fab_razon_social as 'fabricante'
                    from detalle_pedido_fd dp
                    inner join producto pro on dp.dpfd_pro_id = pro.pro_id
                    inner join fabricante f on pro.pro_fab_id = f.fab_id
                    inner join pedido_fd p on dp.dpfd_ped_id = p.pfd_id
                    inner join grupo_pedido_fd gp on p.pfd_gpfd_id = gp.gpfd_id
                    where 
                        gp.gpfd_id = " . trim($pedido) . "";
            $resultado = $_SESSION["Connection"]->query($select);
            while ($row = $resultado->fetch_assoc()) {
                /**Guardamos los pedidos */
                $grupo_pedido[] = array(
                    "codigo"        => trim($row["codigo"]),
                    "foto"              => "https://app.izipedidos.pe/" . substr(trim($row["foto"]), 2),
                    // "foto"              => trim($row["foto"]),
                    // "foto"              => "http://192.168.1.4/easy/" . substr(trim($row["foto"]), 2),
                    "producto"      => trim($row["producto"]),
                    "marca"         => trim($row["marca"]),
                    "cantidad"      => trim($row["cantidad"]),
                    "precio"        => trim($row["precio"]),
                    "total"         => trim($row["total"]),
                    "fabricante"    => trim($row["fabricante"])
                );
            }
            echo json_encode($grupo_pedido);
            $resultado->close();
        }

        /**Ejecutamos la función para leer el pedido */
        leer_pedido($pedido);
        break;

    case "EliminarPedido":
        /**Recibimos el pedido */
        $pedido  = $_POST["pedido"];

        /**Función para eliminar el pedido */
        function eliminar_pedido($pedido)
        {
            /**Traemos el estado actual del pedido */
            $select = "select p.pfd_estado as 'estado' from pedido_fd p
                inner join grupo_pedido_fd gp on p.pfd_gpfd_id = gp.gpfd_id
                where 
                    gp.gpfd_id = " . trim($pedido) . "";
            $resultado = $_SESSION["Connection"]->query($select);
            while ($row = $resultado->fetch_assoc()) {
                /**Guardamos el estado del pedido */
                $estado = trim($row["estado"]);
            }
            $resultado->close();

            if ($estado === "ATENDIDO") {
                $update = "update pedido_fd p
                inner join grupo_pedido_fd gp on p.pfd_gpfd_id = gp.gpfd_id
                set p.pfd_estado = 'ELIMINADO POR DISTRIBUIDOR'
                where 
                    gp.gpfd_id = " . trim($pedido) . "";
                if ($_SESSION['Connection']->query($update) === true) {
                    echo "Pedido eliminado";
                } else {
                    echo  "ERROR: No se pudo eliminar el pedido";
                }
            } else {
                $update = "update pedido_fd p
                inner join grupo_pedido_fd gp on p.pfd_gpfd_id = gp.gpfd_id
                set p.pfd_estado = 'ELIMINADO POR DISTRIBUIDOR'
                where 
                    gp.gpfd_id = " . trim($pedido) . "";
                if ($_SESSION['Connection']->query($update) === true) {
                    $select = "select 
                            pro.pro_id as 'producto',
                            dp.dpfd_cantidad as 'cantidad'
                        from detalle_pedido_fd dp
                        inner join producto pro on dp.dpfd_pro_id = pro.pro_id
                        inner join pedido_fd p on dp.dpfd_ped_id = p.pfd_id
                        inner join grupo_pedido_fd gp on p.pfd_gpfd_id = gp.gpfd_id
                        where 
                            gp.gpfd_id = " . trim($pedido) . "";
                    $resultado = $_SESSION["Connection"]->query($select);
                    while ($row = $resultado->fetch_assoc()) {
                        /**Guardamos los productos */
                        $productos[] = array(
                            "producto"      => trim($row["producto"]),
                            "cantidad"      => trim($row["cantidad"]),
                        );
                    }
                    $resultado->close();

                    /**Restauramos el stock de los productos */
                    for ($i = 0; $i < count($productos); $i++) {
                        $update = "update producto_fabricante set pf_stock = pf_stock + " . trim($productos[$i]["cantidad"]) . "
                            where pf_pro_id = " . trim($productos[$i]["producto"]) . "";
                        if ($_SESSION['Connection']->query($update) === true) {
                            echo "Pedido eliminado";
                        } else {
                            echo  "ERROR: No se pudo restaurar el stock";
                        }
                    }
                } else {
                    echo  "ERROR: No se pudo eliminar el pedido";
                }
            }
        }

        /**Ejecutamos la función */
        eliminar_pedido($pedido);
        break;
}
