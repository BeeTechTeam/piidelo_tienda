<?php
require_once("../../database/connection.php");

/**Recibimos el m&eacute;todo */
$metodo = $_POST["metodo"];

switch ($metodo) {
        /**Función para listar los productos más vendidos del mes */
    case "Todos":
        $cliente = $_POST["cliente"];

        function todos($cliente, $connection)
        {
            /**Favoritos del mes */
            $select =
                "select p.* from producto p 
                    where 
                        p.prod_estado = 'ACTIVO'
                        and 
                        (p.prod_nuevo = 'NO' or p.prod_nuevo is NULL)
                        and
                        p.prod_oferta_inicio is NULL
                    group by p.prod_id
                    order by p.prod_nombre asc";
            $resultado = mysqli_query($connection, $select);
            $productos = [];
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    /**Verificar si es favorito */
                    $favorito = false;
                    $select_favorito = "select fav_cli_id, fav_prod_id from favoritos f where f.fav_cli_id = '" . $cliente . "' and f.fav_prod_id = '" . $row["prod_id"] . "'";
                    $resultado_favorito = mysqli_query($connection, $select_favorito);
                    if ($resultado_favorito->num_rows > 0) {
                        $favorito = true;
                    } else {
                        $favorito = false;
                    }
                    $productos[] = array(
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"],
                        "prod_favorito" => $favorito
                    );
                }
            } else {
                $productos = [];
            }
            echo json_encode($productos);
            $resultado->close();
        }
        todos($cliente, $connection);
        break;

        /**Función para listar los productos nuevos */
    case "Nuevos":
        $cliente = $_POST["cliente"];
        function nuevos($connection, $cliente)
        {
            $select =
                "select p.* from producto p
                    where 
                        p.prod_estado = 'ACTIVO'
                        and
                        p.prod_nuevo = 'SI'
                        and
                        p.prod_oferta_inicio is NULL
                    group by p.prod_id
                    order by p.prod_nombre asc";
            $resultado = mysqli_query($connection, $select);
            $productos = [];
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    /**Verificar si es favorito */
                    $favorito = false;
                    $select_favorito = "select fav_cli_id, fav_prod_id from favoritos f where f.fav_cli_id = '" . $cliente . "' and f.fav_prod_id = '" . $row["prod_id"] . "'";
                    $resultado_favorito = mysqli_query($connection, $select_favorito);
                    if ($resultado_favorito->num_rows > 0) {
                        $favorito = true;
                    } else {
                        $favorito = false;
                    }

                    $productos[] = array(
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"],
                        "prod_favorito" => $favorito
                    );
                }
            } else {
                $productos = [];
            }
            echo json_encode($productos);
            $resultado->close();
        }
        nuevos($connection, $cliente);
        break;

        /**Función para listar las ofetas */
    case "Ofertas":
        $cliente = $_POST["cliente"];
        function ofertas($cliente, $connection)
        {
            $select =
                "select p.* from producto p
                where 
                    (
                        (date_format(now(),'%Y-%m-%d') between date_format(p.prod_oferta_inicio, '%Y-%m-%d') and date_format(p.prod_oferta_fin, '%Y-%m-%d'))
                        or
                        p.prod_oferta_especial = 'SI'
                    )
                    and
                    p.prod_estado = 'ACTIVO'
                    and 
                    (p.prod_nuevo is NULL or p.prod_nuevo = 'NO')
                    and
                    p.prod_oferta_inicio is not NULL
                group by p.prod_id
                order by p.prod_nombre asc";
            $resultado = mysqli_query($connection, $select);
            $productos = [];
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    /**Verificar si es favorito */
                    $favorito = false;
                    $select_favorito = "select fav_cli_id, fav_prod_id from favoritos f where f.fav_cli_id = '" . $cliente . "' and f.fav_prod_id = '" . $row["prod_id"] . "'";
                    $resultado_favorito = mysqli_query($connection, $select_favorito);
                    if ($resultado_favorito->num_rows > 0) {
                        $favorito = true;
                    } else {
                        $favorito = false;
                    }

                    $productos[] = array(
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"],
                        "prod_favorito" => $favorito
                    );
                }
            } else {
                $productos = [];
            }
            echo json_encode($productos);
            $resultado->close();
        }
        ofertas($cliente, $connection);
        break;

        /**Función para buscar productos */
    case "BuscarProductos":
        $nombre = trim($_POST["nombre"]);
        $cliente = trim($_POST["cliente"]);

        function buscar_productos($nombre, $connection, $cliente)
        {
            /**Primero, buscamos en todos los productos */
            /**Todos */
            $productos = [];
            $select =
                "select p.* from producto p 
                    where 
                        p.prod_nombre like '%" . $nombre . "%'
                        and
                        p.prod_estado = 'ACTIVO'
                        and 
                        (p.prod_nuevo = 'NO' or p.prod_nuevo is NULL)
                        and
                        p.prod_oferta_inicio is NULL
                    group by p.prod_id
                    order by p.prod_nombre asc
                ";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                /**Es parte de todos los productos */
                while ($row = $resultado->fetch_assoc()) {
                    /**Verificar si es favorito */
                    $favorito = false;
                    $select_favorito = "select fav_cli_id, fav_prod_id from favoritos f where f.fav_cli_id = '" . $cliente . "' and f.fav_prod_id = '" . $row["prod_id"] . "'";
                    $resultado_favorito = mysqli_query($connection, $select_favorito);
                    if ($resultado_favorito->num_rows > 0) {
                        $favorito = true;
                    } else {
                        $favorito = false;
                    }
                    $producto = array(
                        "prod_tipo" => "Todos",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"],
                        "prod_favorito" => $favorito
                    );
                    array_push($productos, $producto);
                }
                $resultado->close();
            }

            /**Segundo, buscamos en nuevos */
            $select =
                "select p.* from producto p
                    where 
                        p.prod_nombre like '%" . $nombre . "%'
                        and
                        p.prod_estado = 'ACTIVO'
                        and
                        p.prod_nuevo = 'SI'
                        and
                        p.prod_oferta_inicio is NULL
                    group by p.prod_id";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                /**Es un producto nuevo */
                while ($row = $resultado->fetch_assoc()) {
                    /**Verificar si es favorito */
                    $favorito = false;
                    $select_favorito = "select fav_cli_id, fav_prod_id from favoritos f where f.fav_cli_id = '" . $cliente . "' and f.fav_prod_id = '" . $row["prod_id"] . "'";
                    $resultado_favorito = mysqli_query($connection, $select_favorito);
                    if ($resultado_favorito->num_rows > 0) {
                        $favorito = true;
                    } else {
                        $favorito = false;
                    }
                    $producto = array(
                        "prod_tipo" => "Nuevo",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"],
                        "prod_favorito" => $favorito
                    );
                    array_push($productos, $producto);
                }
                $resultado->close();
            }

            /**Tercero, buscamos en ofertas */
            $select =
                "select p.* from producto p
                        where 
                            p.prod_nombre like '%" . $nombre . "%'
                            and
                            (
                                (date_format(now(),'%Y-%m-%d') between date_format(p.prod_oferta_inicio, '%Y-%m-%d') and date_format(p.prod_oferta_fin, '%Y-%m-%d'))
                                or
                                p.prod_oferta_especial = 'SI'
                            )
                            and
                            p.prod_estado = 'ACTIVO'
                            and 
                            p.prod_oferta_inicio is not NULL
                group by p.prod_id";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                /**Es una oferya */
                while ($row = $resultado->fetch_assoc()) {
                    /**Verificar si es favorito */
                    $favorito = false;
                    $select_favorito = "select fav_cli_id, fav_prod_id from favoritos f where f.fav_cli_id = '" . $cliente . "' and f.fav_prod_id = '" . $row["prod_id"] . "'";
                    $resultado_favorito = mysqli_query($connection, $select_favorito);
                    if ($resultado_favorito->num_rows > 0) {
                        $favorito = true;
                    } else {
                        $favorito = false;
                    }
                    $producto = array(
                        "prod_tipo" => "Oferta",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"],
                        "prod_favorito" => $favorito
                    );
                    array_push($productos, $producto);
                }
                $resultado->close();
            }
            echo json_encode($productos);
        }
        buscar_productos($nombre, $connection, $cliente);
        break;

        /**Función para leer producto por su código */
    case "LeerProducto":
        $codigo = trim($_POST["producto"]);

        function leer_producto($codigo, $connection)
        {
            /**Traemos el producto */
            /**Primero, buscamos en todos los productos */
            /**Todos */
            $select =
                "select p.* from producto p 
                    where 
                        p.prod_id = '" . $codigo . "'
                        and
                        p.prod_estado = 'ACTIVO'
                        and 
                        (p.prod_nuevo = 'NO' or p.prod_nuevo is NULL)
                        and
                        p.prod_oferta_inicio is NULL
                    group by p.prod_id
                    order by p.prod_nombre asc";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                /**Es parte de todos los productos*/
                while ($row = $resultado->fetch_assoc()) {
                    $producto = array(
                        "prod_tipo" => "Favorito",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"]
                    );
                }
                echo json_encode($producto);
                $resultado->close();
                return;
            }
            /**Segundo, buscamos en nuevos */
            $select =
                "select p.* from producto p
                    where 
                        p.prod_id = '" . $codigo . "'
                        and
                        p.prod_estado = 'ACTIVO'
                        and
                        p.prod_nuevo = 'SI'
                        and
                        p.prod_oferta_inicio is NULL";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                /**Es un producto nuevo */
                while ($row = $resultado->fetch_assoc()) {
                    $producto = array(
                        "prod_tipo" => "Nuevo",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"]
                    );
                }
                echo json_encode($producto);
                $resultado->close();
                return;
            }

            /**Tercero, buscamos en ofertas */
            $select =
                "select p.* from producto p
                    where 
                        p.prod_id = '" . $codigo . "'
                        and
                        (
                            (date_format(now(),'%Y-%m-%d') between date_format(p.prod_oferta_inicio, '%Y-%m-%d') and date_format(p.prod_oferta_fin, '%Y-%m-%d'))
                            or
                            p.prod_oferta_especial = 'SI'
                        )
                        and
                        p.prod_estado = 'ACTIVO'
                        and 
                        p.prod_oferta_inicio is not NULL";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                /**Es una oferta */
                while ($row = $resultado->fetch_assoc()) {
                    $producto = array(
                        "prod_tipo" => "Oferta",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"]
                    );
                }
                echo json_encode($producto);
                $resultado->close();
                return;
            }
        }
        leer_producto($codigo, $connection);
        break;

        /**Función para marcar un producto como favorito */
    case "AgregarFavorito":
        $producto = trim($_POST["producto"]);
        $cliente = trim($_POST["cliente"]);

        function agregar_favorito($cliente, $producto, $connection)
        {
            $insert = "insert into favoritos(fav_cli_id, fav_prod_id) values('" . $cliente . "', '" . $producto . "')";
            if (mysqli_query($connection, $insert) === true) {
                $response = array(
                    "codigo" => 111,
                    "mensaje" => "Favorito agregado correctamente"
                );
            } else {
                $response = array(
                    "codigo" => 112,
                    "mensaje" => "Error al agregar favorito"
                );
            }
            echo json_encode($response);
        }

        agregar_favorito($cliente, $producto, $connection);
        break;

        /**Función para eliminar de favoritos */
    case "EliminarFavorito":
        $producto = trim($_POST["producto"]);
        $cliente = trim($_POST["cliente"]);

        function eliminar_favorito($cliente, $producto, $connection)
        {
            $delete = "delete from favoritos where fav_cli_id = '" . $cliente . "' and fav_prod_id = '" . $producto . "'";
            if (mysqli_query($connection, $delete) === true) {
                $response = array(
                    "codigo" => 111,
                    "mensaje" => "Favorito eliminado correctamente"
                );
            } else {
                $response = array(
                    "codigo" => 112,
                    "mensaje" => "Error al eliminar favorito" . $delete
                );
            }
            echo json_encode($response);
        }

        eliminar_favorito($cliente, $producto, $connection);
        break;

        /**Listar los favoritos del mes favoritos del usuario*/
    case "Todos_favoritos":
        $cliente = $_POST["cliente"];

        function todos_favoritos($cliente, $connection)
        {
            /**Favoritos del mes */
            $select =
                "select p.* from producto p
                    inner join favoritos f on p.prod_id = f.fav_prod_id 
                    where 
                        f.fav_cli_id = '" . $cliente . "'
                        and
                        p.prod_estado = 'ACTIVO'
                        and 
                        (p.prod_nuevo = 'NO' or p.prod_nuevo is NULL)
                        and
                        p.prod_oferta_inicio is NULL
                    group by p.prod_id
                    order by p.prod_nombre asc";
            $resultado = mysqli_query($connection, $select);
            $productos = [];
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = array(
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"],
                        "prod_favorito" => true
                    );
                }
            } else {
                $productos = [];
            }
            echo json_encode($productos);
            $resultado->close();
        }
        todos_favoritos($cliente, $connection);
        break;

        /**Función para listar los productos nuevos favoritos del usuario */
    case "Nuevos_favoritos":
        $cliente = $_POST["cliente"];
        function nuevos_favoritos($connection, $cliente)
        {
            $select =
                "select p.* from producto p
                        inner join favoritos f on p.prod_id = f.fav_prod_id
                        where 
                            f.fav_cli_id = '" . $cliente . "'
                            and
                            p.prod_estado = 'ACTIVO'
                            and
                            p.prod_nuevo = 'SI'
                            and
                            p.prod_oferta_inicio is NULL
                        group by p.prod_id
                        order by p.prod_nombre asc";
            $resultado = mysqli_query($connection, $select);
            $productos = [];
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = array(
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"],
                        "prod_favorito" => true
                    );
                }
            } else {
                $productos = [];
            }
            echo json_encode($productos);
            $resultado->close();
        }
        nuevos_favoritos($connection, $cliente);
        break;

        /**Función para listar las ofertas favoritos del uusario */
    case "Ofertas_favoritos":
        $cliente = $_POST["cliente"];
        function ofertas_favoritos($cliente, $connection)
        {
            $select =
                "select p.*from producto p
                        inner join favoritos f on p.prod_id = f.fav_prod_id
                        where 
                            f.fav_cli_id = '" . $cliente . "'
                            and
                            (
                                (date_format(now(),'%Y-%m-%d') between date_format(p.prod_oferta_inicio, '%Y-%m-%d') and date_format(p.prod_oferta_fin, '%Y-%m-%d'))
                                or
                                p.prod_oferta_especial = 'SI'
                            )
                            and
                            p.prod_estado = 'ACTIVO'
                            and 
                        p.prod_oferta_inicio is not NULL
                    group by p.prod_id
                    order by p.prod_nombre asc";
            $resultado = mysqli_query($connection, $select);
            $productos = [];
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = array(
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => utf8_decode($row["prod_nombre"]),
                        "prod_descripcion" => utf8_decode($row["prod_descripcion"]),
                        "prod_detalles" => utf8_decode($row["prod_detalles"]),
                        "prod_foto" => ruta_imagenes . "productos/" . utf8_decode($row["prod_foto"]),
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"],
                        "prod_favorito" => true
                    );
                }
            } else {
                $productos = [];
            }
            echo json_encode($productos);
            $resultado->close();
        }
        ofertas_favoritos($cliente, $connection);
        break;
}
