<?php
require_once("../../database/connection.php");
/**Creamos la conexión */
$connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");

/**Recibimos el método */
$metodo = $_POST["metodo"];

/**Ruta de fotos de los sliders */
$ruta = "http://192.168.1.4/piidelo/piidelo_backoffice/images/sliders/";
// $ruta = "https://ecommerce.izipedidos.pe/backoffice/images/sliders/";

switch ($metodo) {
    case "LeerSliders":
        function leer_sliders($ruta, $connection)
        {

            $select = "select sli_foto from sliders where '" . date("Y-m-d") . "' between sli_inicio and sli_fin";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo "<li class='splide__slide'><img src='" . $ruta . $row["sli_foto"] . "' style='width: 100%;'></li>";
                }
            } else {
                echo "<li class='splide__slide'><img src='image/banner_default.png' style='width: 100%;'></li>";
            }
            $resultado->close();
        }
        leer_sliders($ruta, $connection);
        break;
}
