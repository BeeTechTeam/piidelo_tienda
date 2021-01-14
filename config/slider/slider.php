<?php
require_once("../../database/connection.php");

/**Recibimos el m&eacute;todo */
$metodo = $_POST["metodo"];

switch ($metodo) {
    case "LeerSliders":
        function leer_sliders($connection)
        {

            $select = "select sli_foto from sliders where '" . date("Y-m-d") . "' between sli_inicio and sli_fin";
            $resultado = mysqli_query($connection, $select);
            $sliders = [];
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $sliders[] = array(
                        "ruta" => ruta_imagenes . "sliders/" . $row["sli_foto"]
                    );
                }
                $resultado->close();
            } else {
                $sliders[] = array(
                    "ruta" => 'image/banner_default.png'
                );
            }
            echo json_encode($sliders);
        }
        leer_sliders($connection);
        break;
}
