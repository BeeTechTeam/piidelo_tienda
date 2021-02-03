<?php

setlocale(LC_ALL, "es_ES");
date_default_timezone_set("UTC");
date_default_timezone_set("America/Lima");
$develop = "on";
if ($develop === "on") {
    define("server", "localhost");
    define("user", "root");
    define("password", "");
    define("database", "ecommerce");
    define("ruta_imagenes", "http://localhost/piidelo/piidelo_backoffice/images/");
    /**Creamos la conexión */
    $connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");
    /**Establecemos el conjunto de  */
    $connection->set_charset("utf8");
} else {
    define("server", "localhost");
    define("user", "piidelo_root");
    define("password", "vlmA}Pn#ty?C");
    define("database", "piidelo_ecommerce");
    define("ruta_imagenes", "https://admin.piidelo.com/images/");
    /**Creamos la conexión */
    $connection = mysqli_connect(server, user, password, database) or die("No se pudo conectar a la base de datos");
    /**Establecemos el conjunto de  */
    $connection->set_charset("utf8");
}
