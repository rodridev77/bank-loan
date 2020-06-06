<?php

include_once "environment.php";

include "libs/vendor/autoload.php";
//include_once dirname("my_autoload") . "/my_autoload.php";

date_default_timezone_set('America/Sao_Paulo');

// CONFIGURAÇÃO DO AMBIENTE #####################
if (ENVIRONMENT == "development") {
    define("BASE_URL", "http://localhost/bank-loan");
} else {
    define("BASE_URL", "http://meusite.com.br/");
}

// CONFIGURAÇÃO DO BANDO DE DADOS #####################
define('HOST', 'localhost;port = 3306');
define('DBNAME', 'bank');
define('USER', 'root');
define('PASS', '');
define('DRIVER', 'mysql');
define('CHARSET', 'utf8');

//Configuração de servidor SMTP GOOGLE
define("MAIL",[
    "Host" => 'smtp.gmail.com',
    "SMTPSecure" => 'tls',
    "Username" => 'bloanprojeto@gmail.com',
    "Password" => 'bloan123456',
    "Port" => 587
]);



