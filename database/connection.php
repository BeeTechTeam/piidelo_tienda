<?php

setlocale(LC_ALL, "es_ES");
date_default_timezone_set("UTC");
date_default_timezone_set("America/Lima");
$develop = "off";
if ($develop === "on") {
    define("server", "localhost");
    define("user", "root");
    define("password", "");
    define("database", "ecommerce");
    define("ruta_imagenes", "http://localhost/piidelo/piidelo_backoffice/images/");
} else {
    define("server", "localhost");
    define("user", "piidelo_root");
    define("password", "vlmA}Pn#ty?C");
    define("database", "piidelo_ecommerce");
    define("ruta_imagenes", "https://www.pidelo.com/admin/images/");
}
