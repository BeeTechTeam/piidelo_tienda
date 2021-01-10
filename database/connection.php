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
} else {
}
