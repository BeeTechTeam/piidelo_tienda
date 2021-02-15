<?php
require_once("../../database/connection.php");
require 'vendor/autoload.php';

/**Recibimos el correo  */
$correo = trim($_POST["correo"]);

function recupear_password($connection, $correo)
{
    $select = "select usu_password from usuario where usu_usuario = '" . $correo . "' and usu_estado = 'ACTIVO'";
    $response = [];
    if ($resultado = mysqli_query($connection, $select)) {
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $password = $row["usu_password"];
            }
            $resultado->close();
            $htmlContent =
                '
                <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Document</title>
                        <style>
                            @import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap");
                            body {
                                font-family: "Quicksand";
                            }
                        </style>
                    </head>

                    <body>
                        <div style="text-align: center;">
                            <h1>Recuperaci&oacute;n de contraseña de <a href="https://www.piidelo.com">piidelo.com</a> </h1>
                            <img src="https://www.piidelo.com/image/logo.png" alt="Piidelo.com" title="Piidelo.com" width="400px">
                            <p>Tu contraseña es: <b>' . $password . '</b></p>
                            <p>Te recomendamos cambiarla, anotarla y guardarla en un lugar seguro.</p>
                            <p>Atentamente: Equipo de soporte de Piidelo.com</p>
                        </div>
                    </body>

                </html>
                                ';

            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("holapiidelo@gmail.com", "Piidelo.com");
            $email->setSubject("RECUPERAR CONTRASEÑA - PIIDELO.COM");
            $email->addTo($correo, $correo);
            $email->addContent("text/html", $htmlContent);
            $sendgrid = new \SendGrid("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");
            try {
                $response = $sendgrid->send($email);
                $codigo =  $response->statusCode();
            } catch (Exception $e) {
                echo 'Caught exception: ' . $e->getMessage() . "\n";
            }
            if (
                $codigo === 202
            ) {
                $response = array(
                    "codigo" => 200,
                    "mensaje" => "Tu contraseña ha sido enviada al correo " . $correo . ". Por favor revisa tu bandeja de entrada."
                );
            } else {
                $response = array(
                    "codigo" => 500,
                    "mensaje" => "Error: Intente más tarde por favor."
                );
            }
        } else {
            $response = array(
                "codigo" => 400,
                "mensaje" => "El correo " . $correo . " no existe"
            );
        }
    } else {
        $response = array(
            "codigo" => 600,
            "mensaje" => "Error al consultar correo: " . $connection->error
        );
    }

    echo json_encode($response);
}

recupear_password($connection, $correo);
