<?php
function init()
{
    require 'vendor/autoload.php'; // Load Composer autoloader
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

function createConnection()
{
    $mysqli = mysqli_init();
    $mysqli->real_connect($_ENV["DB_HOST"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"], $_ENV["DB_NAME"]);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        return false;
    }
    return $mysqli;
}

init();
