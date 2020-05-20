<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} elseif (session_status() === PHP_SESSION_DISABLED) {
    echo "Error: Verifique as configurações de sessão";
}

include_once "app/config/config.inc.php";
include_once "libs/vendor/autoload.php";

$core = new app\Core\Core();
$core->run();