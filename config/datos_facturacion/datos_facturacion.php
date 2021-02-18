<?php
require_once("../../database/connection.php");

/**Recibimos el m&eacute;todo */
$metodo = $_POST["metodo"];

switch ($metodo) {
        /**Función para agregar nuevos comprobantes */
    case "AgregarComprobante":
        $tipo = trim($_POST["tipo"]);
        $documento = trim($_POST["documento"]);
        $nombres_razon = utf8_encode(trim($_POST["nombres_razon"]));
        $direccion = trim($_POST["direccion"]);
        $cliente = trim($_POST["cliente"]);

        function crear_comprobante($tipo, $documento, $nombres_razon, $direccion, $cliente, $connection)
        {
            $insert = "insert into datos_facturacion(
                df_tipo,
                df_nombres_razon_social,
                df_dni_ruc,
                df_direccion,
                df_estado,
                df_cliente) 
                values(
                    '" . $tipo . "',
                    '" . $nombres_razon . "',
                    '" . $documento . "',
                    '" . $direccion . "',
                    'ACTIVA',
                    '" . $cliente . "'
                    )";
            if (mysqli_query($connection, $insert) === true) {
                $response = array(
                    "codigo" => 107,
                    "mensaje" => "Comprobante agregado correctamente"
                );
            } else {
                $response = array(
                    "codigo" => 108,
                    "mensaje" => "Error al agregar comprobante"
                );
            }
            echo  json_encode($response);
        }

        crear_comprobante($tipo, $documento, $nombres_razon, $direccion, $cliente, $connection);
        break;

        /**Función para listar los comprobantes ya registrados */
    case "ListarComprobantes":
        $codigo = trim($_POST["codigo"]);

        function listar_comprobantes($codigo, $connection)
        {
            $select = "select 
                            df.df_id codigo,
                            df.df_tipo tipo,
                            df.df_nombres_razon_social nombres_razon,
                            df.df_dni_ruc documento,
                            df.df_direccion direccion
                        from datos_facturacion df 
                        inner join cliente c on df.df_cliente = c.cli_id
                        where c.cli_id = '" . $codigo . "' and df.df_estado = 'ACTIVA'
                        order by df.df_id desc";
            $result = mysqli_query($connection, $select);
            $comprobantes = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $comprobantes[] = array(
                        "codigo" => $row["codigo"],
                        "tipo" => $row["tipo"],
                        "nombres_razon" => $row["nombres_razon"],
                        "documento" => $row["documento"],
                        "direccion" => $row["direccion"]
                    );
                }
                $result->close();
            } else {
                $comprobantes = [];
            }
            echo json_encode($comprobantes);
        }

        listar_comprobantes($codigo, $connection);
        break;

        /**Función para leer una dirección por código */
    case "LeerComprobante":
        $codigo = trim($_POST["codigo"]);

        function leer_comprobante($codigo, $connection)
        {
            $select = "select 
                            df.df_id codigo,
                            df.df_tipo tipo,
                            df.df_nombres_razon_social nombres_razon,
                            df.df_dni_ruc documento,
                            df.df_direccion direccion
                    from datos_facturacion df 
                    where df.df_id = '" . $codigo . "' and df.df_estado = 'ACTIVA'";
            $result = mysqli_query($connection, $select);
            $direccion = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $direccion = array(
                        "codigo" => $row["codigo"],
                        "tipo" => $row["tipo"],
                        "nombres_razon" => $row["nombres_razon"],
                        "documento" => $row["documento"],
                        "direccion" => $row["direccion"]
                    );
                }
                $result->close();
            } else {
                $direccion = [];
            }
            echo json_encode($direccion);
        }

        leer_comprobante($codigo, $connection);
        break;

        /**Función para editar un comprobante ya existente */
    case "EditarComprobante":
        $codigo = trim($_POST["codigo"]);
        $tipo = trim($_POST["tipo"]);
        $documento = trim($_POST["documento"]);
        $nombres_razon = utf8_encode(trim($_POST["nombres_razon"]));
        $direccion = trim($_POST["direccion"]);

        function editar_comprobante($codigo, $tipo, $documento, $nombres_razon, $direccion, $connection)
        {
            $delete = "update datos_facturacion set 
                            df_tipo = '" . $tipo . "',
                            df_nombres_razon_social = '" . $nombres_razon . "',
                            df_dni_ruc = '" . $documento . "',
                            df_direccion = '" . $direccion . "'
                        where df_id = '" . $codigo . "'";
            if (mysqli_query($connection, $delete) === true) {
                $response = array(
                    "codigo" => 111,
                    "mensaje" => "Comprobante editado correctamente"
                );
            } else {
                $response = array(
                    "codigo" => 112,
                    "mensaje" => "Error al editar comprobante"
                );
            }
            echo json_encode($response);
        }

        editar_comprobante($codigo, $tipo, $documento, $nombres_razon, $direccion, $connection);
        break;

        /**Función para eliminar un comprobante por su código */
    case "EliminarComprobante":
        $codigo = trim($_POST["codigo"]);

        function eliminar_comprobante($codigo, $connection)
        {
            $delete = "update datos_facturacion set df_estado = 'ELIMINADA' where df_id = '" . $codigo . "'";
            if (mysqli_query($connection, $delete) === true) {
                $response = array(
                    "codigo" => 111,
                    "mensaje" => "Comprobante eliminado correctamente"
                );
            } else {
                $response = array(
                    "codigo" => 112,
                    "mensaje" => "Error al eliminar comprobante"
                );
            }
            echo json_encode($response);
        }

        eliminar_comprobante($codigo, $connection);
        break;
}
