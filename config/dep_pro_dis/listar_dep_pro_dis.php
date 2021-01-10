<?php
require_once("../../database/connection.php");

/**Creamos la conexi&oacute;n */
$connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");

/**Recibimos el m&eacute;todo a ejecutar */
$metodo = $_POST["metodo"];
switch ($metodo) {
        /**Listar departamentos */
    case "ListarDepartamentos":
        function listar_departamentos($connection)
        {
            $select = "select * from departamento";
            $result = mysqli_query($connection, $select);
            $departamentos = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $departamentos[] = array(
                        "codigo" => $row["dep_id"],
                        "nombre" => $row["dep_nombre"]
                    );
                }
                echo json_encode($departamentos);
                $result->close();
            } else {
                echo json_encode($departamentos);
            }
        }
        listar_departamentos($connection);
        break;

        /**Listar provincias */
    case "ListarProvincias":
        $departamento = trim($_POST["departamento"]);

        function listar_provincias($departamento, $connection)
        {
            $select = "select * from provincia where provi_departamento = '" . $departamento . "'";
            $result = mysqli_query($connection, $select);
            $provincias = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $provincias[] = array(
                        "codigo" => $row["provi_id"],
                        "nombre" => $row["provi_nombre"]
                    );
                }
                echo json_encode($provincias);
                $result->close();
            } else {
                echo json_encode($provincias);
            }
        }
        listar_provincias($departamento, $connection);
        break;

        /**Listar distritos */
    case "ListarDistritos":
        $provincia = trim($_POST["provincia"]);

        function listar_distritos($provincia, $connection)
        {
            $select = "select * from distrito where dis_provincia = '" . $provincia . "'";
            $result = mysqli_query($connection, $select);
            $distritos = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $distritos[] = array(
                        "codigo" => $row["dis_id"],
                        "nombre" => $row["dis_nombre"]
                    );
                }
                echo json_encode($distritos);
                $result->close();
            } else {
                echo json_encode($distritos);
            }
        }
        listar_distritos($provincia, $connection);
        break;

    case "DeliveryDistritos":
        $provincia = trim($_POST["provincia"]);
        function llenar_tabla($provincia, $connection)
        {
            $select = "select d.dis_id, de.dep_nombre, p.provi_nombre, d.dis_nombre, d.dis_delivery from distrito d
                        inner join provincia p on d.dis_provincia = p.provi_id
                        inner join departamento de on p.provi_departamento = de.dep_id
                        where p.provi_id = " . $provincia . "";
            $resultado = mysqli_query($connection, $select);
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='left-align' style='width: 10%;'>" . $row["dep_nombre"] . "</td>";
                    echo "<td class='left-align' style='width: 10%;'>" . $row["provi_nombre"] . "</td>";
                    echo "<td class='left-align' style='width: 10%;'>" . $row["dis_nombre"] . "</td>";
                    echo "<td class='left-align' style='width: 10%;'>
                            <div class='row'>
                                <div class='col s6'>
                                    <div class='input-field'>
                                        <input type='number' style='text-align: center; font-family: Quicksand' id='txt_delivery_" . $row["dis_id"] . "' value = '" . $row["dis_delivery"] . "'>
                                    </div>
                                </div>
                                <div class='col s6'>
                                    <div class='input-field'>
                                        <button class='btn' onclick='guardar_delivery(" . $row["dis_id"] . ")'>Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td class='left-align' colspan='9' style='text-align: center;'>No se econtraron datos</td>";
                echo "</tr>";
            }
            $resultado->close();
        }
        llenar_tabla($provincia, $connection);
        break;

    case "GuardarDelivery":
        $distrito = trim($_POST["distrito"]);
        $delivery = trim($_POST["delivery"]);

        function guardar_delivery($distrito, $delivery, $connection)
        {
            $update = "update distrito set dis_delivery = " . $delivery . " where dis_id = " . $distrito . "";
            if (mysqli_query($connection, $update) === true) {
                $response = array(
                    "codigo" => 109,
                    "mensaje" => "Delivery guardado correctamente"
                );
                echo json_encode($response);
            } else {
                $response = array(
                    "codigo" => 110,
                    "mensaje" => "Error al guardar delivery"
                );
                echo json_encode($response);
            }
        }

        guardar_delivery($distrito, $delivery, $connection);
        break;
}
