<?php
require_once("../connection.php");
$metodo = $_POST["metodo"];
switch ($metodo) {

        /**Distribuidor read */
    case "DistribuidorRead":
        $usuario = trim($_POST["usuario"]);
        function distribuidor_read($usuario)
        {
            $select = "select d.dis_id from distribuidor d 
                inner join usuario u on d.dis_usu_id = u.usu_id
                where d.dis_estado = 'ACTIVO' and u.usu_id = '" . trim($usuario) . "'";
            $resultado = $_SESSION["Connection"]->query($select);
            while ($row = $resultado->fetch_assoc()) {
                $distribuidor = trim($row["dis_id"]);
            }
            echo $distribuidor;
            $resultado->close();
        }
        distribuidor_read($usuario);
        break;

        /**Detalles de mis fabricantes */
    case "DatosFabricantes":
        $distribuidor = trim($_POST["distribuidor"]);
        function distribuidor_read($distribuidor)
        {
            $select = "select 
                            f.fab_razon_social as 'fabricante', 
                            f.fab_telefono as 'telefono', 
                            f.fab_email as 'email' 
                        from fabricante_distribuidor fd
                        inner join fabricante f on fd.fd_fab_id = f.fab_id
                        where fd.fd_dis_id = " . trim($distribuidor) . "";
            $resultado = $_SESSION["Connection"]->query($select);
            while ($row = $resultado->fetch_assoc()) {
                $fabricantes[] = array(
                    "fabricante" => trim($row["fabricante"]),
                    "telefono" => trim($row["telefono"]),
                    "email" => trim($row["email"])
                );
            }
            echo json_encode($fabricantes);
            $resultado->close();
        }
        distribuidor_read($distribuidor);
        break;

    case "LeerSliders":
        $distribuidor = trim($_POST["distribuidor"]);
        function leer_sliders($distribuidor)
        {
            $select = "select fd.fd_fab_id as 'fabricante' from fabricante_distribuidor fd
                where fd.fd_dis_id = '" . trim($distribuidor) . "'";
            $resultado = $_SESSION["Connection"]->query($select);
            $fabricantes = array();
            while ($row = $resultado->fetch_assoc()) {
                array_push($fabricantes, trim($row["fabricante"]));
            }
            $resultado->close();

            $sliders = array();
            for ($i = 0; $i < count($fabricantes); $i++) {
                $select = "select * from publicidad_fabricante where
                                    pf_fab_id = '" . trim($fabricantes[$i]) . "' and
                                    '" . date("Y-m-d") . "' between pf_fecha_inicio and pf_fecha_fin";
                $resultado = $_SESSION['Connection']->query($select);
                while ($row = $resultado->fetch_assoc()) {
                    array_push($sliders, trim($row["pf_slider"]));
                }
            }
            $resultado->close();

            if (count($sliders) > 0) {
                for ($i = 0; $i < count($sliders); $i++) {
                    echo "<img src='" . $sliders[$i] . "' class='custom_slides' style='width: 100%'>";
                }
            } else {
                echo "<img src='../image/banner_default.png' class='custom_slides' style='width: 100%'>";
            }
        }
        leer_sliders($distribuidor);
        break;
}
