<?php
require_once("../../database/connection.php");

/**Recibimos el m&eacute;todo a ejecutar */
$metodo = $_POST["metodo"];
switch ($metodo) {
        /**Listar departamentos */
    case "ListarDepartamentos":
        function listar_departamentos($connection)
        {
            $select = "select dep_id, dep_nombre from departamento";
            $result = mysqli_query($connection, $select);
            $departamentos = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $departamentos[] = array(
                        "codigo" => $row["dep_id"],
                        "nombre" => $row["dep_nombre"]
                    );
                }
                $result->close();
            } else {
                $departamentos = [];
            }
            echo json_encode($departamentos);
        }
        listar_departamentos($connection);
        break;

        /**Listar provincias */
    case "ListarProvincias":
        $departamento = trim($_POST["departamento"]);

        function listar_provincias($departamento, $connection)
        {
            $select = "select provi_id, provi_nombre from provincia where provi_departamento = '" . $departamento . "'";
            $result = mysqli_query($connection, $select);
            $provincias = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $provincias[] = array(
                        "codigo" => $row["provi_id"],
                        "nombre" => $row["provi_nombre"]
                    );
                }
                $result->close();
            } else {
                $provincias = [];
            }
            echo json_encode($provincias);
        }
        listar_provincias($departamento, $connection);
        break;

        /**Listar distritos */
    case "ListarDistritos":
        $provincia = trim($_POST["provincia"]);

        function listar_distritos($provincia, $connection)
        {
            $select = "select dis_id, dis_nombre from distrito where dis_provincia = '" . $provincia . "'";
            $result = mysqli_query($connection, $select);
            $distritos = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $distritos[] = array(
                        "codigo" => $row["dis_id"],
                        "nombre" => $row["dis_nombre"]
                    );
                }
                $result->close();
            } else {
                $distritos = [];
            }
            echo json_encode($distritos);
        }
        listar_distritos($provincia, $connection);
        break;
}
