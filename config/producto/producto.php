<?php
require_once("../../database/connection.php");
/**Creamos la conexión */
$connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");

/**Recibimos el método */
$metodo = $_POST["metodo"];

/**Ruta de fotos de los productos */
$ruta = "http://192.168.1.4/ecommerce/backoffice/images/productos/";
// $ruta = "https://ecommerce.izipedidos.pe/backoffice/images/productos/";

switch ($metodo) {
        /**Leer productos */
    case "FavoritosDelMes":
        function favoritos_del_mes($connection, $ruta)
        {
            /**Favoritos del mes */
            $select =
                "select 
                    p.*,
                    m.mar_nombre,
                    c.cat_nombre,
                    s.subcat_nombre,
                    date_format(pe.ped_fecha_solicitud, '%Y-%m') mes,
                    sum(lp.lp_cantidad) cantidad 
                from producto p
                inner join marca m on p.prod_marca = m.mar_id
                inner join categoria c on p.prod_categoria = c.cat_id
                left join subcategoria s on p.prod_subcategoria = s.subcat_id
                inner join linea_de_pedido lp on p.prod_id = lp.lp_producto
                inner join pedido pe on lp.lp_pedido = pe.ped_id
                where 
                    date_format(pe.ped_fecha_solicitud, '%Y-%m') = '2020-12' 
                    and
                    p.prod_estado = 'ACTIVO'
                    and 
                    (p.prod_nuevo = 'NO' or p.prod_nuevo is NULL)
                    and
                    p.prod_oferta_inicio is NULL
                group by pe.ped_id 
                order by cantidad desc
                limit 12";
            $resultado = mysqli_query($connection, $select);
            $productos = array();
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = array(
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => $row["prod_nombre"],
                        "prod_descripcion" => $row["prod_descripcion"],
                        "prod_detalles" => $row["prod_detalles"],
                        "prod_foto" => $ruta . $row["prod_foto"],
                        "prod_marca" => $row["mar_nombre"],
                        "prod_categoria" => $row["cat_nombre"],
                        "prod_subcategoria" => $row["subcat_nombre"],
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"]
                    );
                }
            } else {
                $productos = array();
            }
            echo json_encode($productos);
            $resultado->close();
        }
        favoritos_del_mes($connection, $ruta);
        break;

    case "Nuevos":
        function nuevos($connection, $ruta)
        {
            $select =
                "select 
                        p.*,
                        m.mar_nombre,
                        c.cat_nombre,
                        s.subcat_nombre
                    from producto p
                    inner join marca m on p.prod_marca = m.mar_id
                    inner join categoria c on p.prod_categoria = c.cat_id
                    left join subcategoria s on p.prod_subcategoria = s.subcat_id
                    where 
                        p.prod_estado = 'ACTIVO'
                        and
                        p.prod_nuevo = 'SI'
                        and
                        p.prod_oferta_inicio is NULL
                    group by p.prod_id
                    order by p.prod_nombre asc
                    limit 12";
            $resultado = mysqli_query($connection, $select);
            $productos = array();
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = array(
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => $row["prod_nombre"],
                        "prod_descripcion" => $row["prod_descripcion"],
                        "prod_detalles" => $row["prod_detalles"],
                        "prod_foto" => $ruta . $row["prod_foto"],
                        "prod_marca" => $row["mar_nombre"],
                        "prod_categoria" => $row["cat_nombre"],
                        "prod_subcategoria" => $row["subcat_nombre"],
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"]
                    );
                }
            } else {
                $productos = array();
            }
            echo json_encode($productos);
            $resultado->close();
        }
        nuevos($connection, $ruta);
        break;

    case "Ofertas":
        function ofertas($connection, $ruta)
        {
            $select =
                "select 
                    p.*,
                    m.mar_nombre,
                    c.cat_nombre,
                    s.subcat_nombre
                from producto p
                inner join marca m on p.prod_marca = m.mar_id
                inner join categoria c on p.prod_categoria = c.cat_id
                left join subcategoria s on p.prod_subcategoria = s.subcat_id
                where 
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
                order by p.prod_nombre asc
                limit 12";
            $resultado = mysqli_query($connection, $select);
            $productos = array();
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = array(
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => $row["prod_nombre"],
                        "prod_descripcion" => $row["prod_descripcion"],
                        "prod_detalles" => $row["prod_detalles"],
                        "prod_foto" => $ruta . $row["prod_foto"],
                        "prod_marca" => $row["mar_nombre"],
                        "prod_categoria" => $row["cat_nombre"],
                        "prod_subcategoria" => $row["subcat_nombre"],
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"]
                    );
                }
            } else {
                $productos = array();
            }
            echo json_encode($productos);
            $resultado->close();
        }
        ofertas($connection, $ruta);
        break;



        /**Buscar productos */
    case "BuscarProductos":
        $nombre = trim($_POST["nombre"]);

        function lista_productos($nombre, $connection, $ruta)
        {
            /**Primero, buscamos en los favoritos del mes */
            /**Favoritos del mes */
            $select =
                "select 
                    p.*,
                    m.mar_nombre,
                    c.cat_nombre,
                    s.subcat_nombre,
                    date_format(pe.ped_fecha_solicitud, '%Y-%m') mes,
                    sum(lp.lp_cantidad) cantidad 
                from producto p
                inner join marca m on p.prod_marca = m.mar_id
                inner join categoria c on p.prod_categoria = c.cat_id
                left join subcategoria s on p.prod_subcategoria = s.subcat_id
                inner join linea_de_pedido lp on p.prod_id = lp.lp_producto
                inner join pedido pe on lp.lp_pedido = pe.ped_id
                where 
                    p.prod_nombre like '%" . $nombre . "%'
                    and
                    date_format(pe.ped_fecha_solicitud, '%Y-%m') = '2020-12' 
                    and
                    p.prod_estado = 'ACTIVO'
                    and 
                    (p.prod_nuevo = 'NO' or p.prod_nuevo is NULL)
                    and
                    p.prod_oferta_inicio is NULL
                group by pe.ped_id 
                order by cantidad desc
                limit 12";
            $resultado = mysqli_query($connection, $select);
            $productos = array();
            if ($resultado->num_rows > 0) {
                /**Es un favorito del mes */
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = array(
                        "prod_tipo" => "Favorito",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => $row["prod_nombre"],
                        "prod_descripcion" => $row["prod_descripcion"],
                        "prod_detalles" => $row["prod_detalles"],
                        "prod_foto" => $ruta . $row["prod_foto"],
                        "prod_marca" => $row["mar_nombre"],
                        "prod_categoria" => $row["cat_nombre"],
                        "prod_subcategoria" => $row["subcat_nombre"],
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"]
                    );
                }
                echo json_encode($productos);
                $resultado->close();
                return;
            }
            /**Segundo, buscamos en nuevos */
            $select =
                "select 
                        p.*,
                        m.mar_nombre,
                        c.cat_nombre,
                        s.subcat_nombre
                    from producto p
                    inner join marca m on p.prod_marca = m.mar_id
                    inner join categoria c on p.prod_categoria = c.cat_id
                    left join subcategoria s on p.prod_subcategoria = s.subcat_id
                    where 
                        p.prod_nombre like '%" . $nombre . "%'
                        and
                        p.prod_estado = 'ACTIVO'
                        and
                        p.prod_nuevo = 'SI'
                        and
                        p.prod_oferta_inicio is NULL
                    group by p.prod_id
                    order by p.prod_nombre asc
                    limit 12";
            $resultado = mysqli_query($connection, $select);
            $productos = array();
            if ($resultado->num_rows > 0) {
                /**Es un producto nuevo */
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = array(
                        "prod_tipo" => "Nuevo",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => $row["prod_nombre"],
                        "prod_descripcion" => $row["prod_descripcion"],
                        "prod_detalles" => $row["prod_detalles"],
                        "prod_foto" => $ruta . $row["prod_foto"],
                        "prod_marca" => $row["mar_nombre"],
                        "prod_categoria" => $row["cat_nombre"],
                        "prod_subcategoria" => $row["subcat_nombre"],
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"]
                    );
                }
                echo json_encode($productos);
                $resultado->close();
                return;
            }

            /**Tercero, buscamos en ofertas */
            $select =
                "select 
                p.*,
                m.mar_nombre,
                c.cat_nombre,
                s.subcat_nombre
            from producto p
            inner join marca m on p.prod_marca = m.mar_id
            inner join categoria c on p.prod_categoria = c.cat_id
            left join subcategoria s on p.prod_subcategoria = s.subcat_id
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
            group by p.prod_id
            order by p.prod_nombre asc
            limit 12";
            $resultado = mysqli_query($connection, $select);
            $productos = array();
            if ($resultado->num_rows > 0) {
                /**Es una oferya */
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = array(
                        "prod_tipo" => "Oferta",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => $row["prod_nombre"],
                        "prod_descripcion" => $row["prod_descripcion"],
                        "prod_detalles" => $row["prod_detalles"],
                        "prod_foto" => $ruta . $row["prod_foto"],
                        "prod_marca" => $row["mar_nombre"],
                        "prod_categoria" => $row["cat_nombre"],
                        "prod_subcategoria" => $row["subcat_nombre"],
                        "prod_stock" => $row["prod_stock"],
                        "prod_precio_regular" => $row["prod_precio_regular"],
                        "prod_precio_oferta" => $row["prod_precio_oferta"],
                        "prod_oferta_inicio" => $row["prod_oferta_inicio"],
                        "prod_oferta_fin" => $row["prod_oferta_fin"],
                        "prod_oferta_especial" => $row["prod_oferta_especial"],
                        "prod_nuevo" => $row["prod_nuevo"]
                    );
                }
                echo json_encode($productos);
                $resultado->close();
                return;
            }
        }
        lista_productos($nombre, $connection, $ruta);
        break;

        /**Leer producto */
    case "LeerProducto":
        $codigo = trim($_POST["producto"]);

        function leer_producto($codigo, $connection, $ruta)
        {
            /**Traemos el producto */
            /**Primero, buscamos en los favoritos del mes */
            /**Favoritos del mes */
            $select =
                "select 
                    p.*,
                    m.mar_nombre,
                    c.cat_nombre,
                    s.subcat_nombre,
                    date_format(pe.ped_fecha_solicitud, '%Y-%m') mes,
                    sum(lp.lp_cantidad) cantidad 
                from producto p
                inner join marca m on p.prod_marca = m.mar_id
                inner join categoria c on p.prod_categoria = c.cat_id
                left join subcategoria s on p.prod_subcategoria = s.subcat_id
                inner join linea_de_pedido lp on p.prod_id = lp.lp_producto
                inner join pedido pe on lp.lp_pedido = pe.ped_id
                where 
                    p.prod_id = '" . $codigo . "'
                    and
                    date_format(pe.ped_fecha_solicitud, '%Y-%m') = '2020-12' 
                    and
                    p.prod_estado = 'ACTIVO'
                    and 
                    (p.prod_nuevo = 'NO' or p.prod_nuevo is NULL)
                    and
                    p.prod_oferta_inicio is NULL
                group by pe.ped_id 
                order by cantidad desc
                limit 12";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                /**Es un favorito del mes */
                while ($row = $resultado->fetch_assoc()) {
                    $producto = array(
                        "prod_tipo" => "Favorito",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => $row["prod_nombre"],
                        "prod_descripcion" => $row["prod_descripcion"],
                        "prod_detalles" => $row["prod_detalles"],
                        "prod_foto" => $ruta . $row["prod_foto"],
                        "prod_marca" => $row["mar_nombre"],
                        "prod_categoria" => $row["cat_nombre"],
                        "prod_subcategoria" => $row["subcat_nombre"],
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
                "select 
                        p.*,
                        m.mar_nombre,
                        c.cat_nombre,
                        s.subcat_nombre
                    from producto p
                    inner join marca m on p.prod_marca = m.mar_id
                    inner join categoria c on p.prod_categoria = c.cat_id
                    left join subcategoria s on p.prod_subcategoria = s.subcat_id
                    where 
                        p.prod_id = '" . $codigo . "'
                        and
                        p.prod_estado = 'ACTIVO'
                        and
                        p.prod_nuevo = 'SI'
                        and
                        p.prod_oferta_inicio is NULL
                    group by p.prod_id
                    order by p.prod_nombre asc
                    limit 12";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                /**Es un producto nuevo */
                while ($row = $resultado->fetch_assoc()) {
                    $producto = array(
                        "prod_tipo" => "Nuevo",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => $row["prod_nombre"],
                        "prod_descripcion" => $row["prod_descripcion"],
                        "prod_detalles" => $row["prod_detalles"],
                        "prod_foto" => $ruta . $row["prod_foto"],
                        "prod_marca" => $row["mar_nombre"],
                        "prod_categoria" => $row["cat_nombre"],
                        "prod_subcategoria" => $row["subcat_nombre"],
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
                "select 
                p.*,
                m.mar_nombre,
                c.cat_nombre,
                s.subcat_nombre
            from producto p
            inner join marca m on p.prod_marca = m.mar_id
            inner join categoria c on p.prod_categoria = c.cat_id
            left join subcategoria s on p.prod_subcategoria = s.subcat_id
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
                p.prod_oferta_inicio is not NULL
            group by p.prod_id
            order by p.prod_nombre asc
            limit 12";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                /**Es una oferya */
                while ($row = $resultado->fetch_assoc()) {
                    $producto = array(
                        "prod_tipo" => "Oferta",
                        "prod_id" => $row["prod_id"],
                        "prod_nombre" => $row["prod_nombre"],
                        "prod_descripcion" => $row["prod_descripcion"],
                        "prod_detalles" => $row["prod_detalles"],
                        "prod_foto" => $ruta . $row["prod_foto"],
                        "prod_marca" => $row["mar_nombre"],
                        "prod_categoria" => $row["cat_nombre"],
                        "prod_subcategoria" => $row["subcat_nombre"],
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
        leer_producto($codigo, $connection, $ruta);
        break;
}
