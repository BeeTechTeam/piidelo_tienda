<?php
require_once("../../database/connection.php");

/**Recibimos el m&eacute;todo */
$metodo = $_POST["metodo"];

switch ($metodo) {
    case "ListarCategorias":
        function listar_categorias($connection)
        {

            $select = "select cat_id, cat_nombre, cat_foto from categoria where cat_estado = 'ACTIVA'";
            $resultado = mysqli_query($connection, $select);
            $categorias = [];
            if ($resultado->num_rows > 0) {
                $categorias[] = array(
                    "codigo" => 0,
                    "nombre" => "TODOS"
                );
                while ($row = $resultado->fetch_assoc()) {
                    $categorias[] = array(
                        "codigo" => $row["cat_id"],
                        "nombre" => strtoupper(utf8_decode($row["cat_nombre"]))
                    );
                }
                $resultado->close();
            } else {
                $categorias = array();
            }
            echo json_encode($categorias);
        }
        listar_categorias($connection);
        break;
}
