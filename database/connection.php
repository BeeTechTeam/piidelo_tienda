<?php

$develop = "on";
if ($develop === "on") {
    define("server", "localhost");
    define("user", "root");
    define("password", "");
    define("database", "ecommerce");
} else {
}
