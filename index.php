<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} elseif (session_status() === PHP_SESSION_DISABLED) {
    echo "Error: Verifique as configurações de sessão";
}

include_once "app/config/config.inc.php";
<<<<<<< HEAD
include_once "libs/vendor/autoload.php";
=======
//include_once dirname("autoload") . "/autoload.php";
>>>>>>> 439978c95539d0207f935b69a9d667b286d81652
//include_once "my_autoload.php";

$core = new app\Core\Core();
$core->run();