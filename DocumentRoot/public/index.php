<?php
require '../config/dev.php';
require '../vendor/autoload.php';
session_start();

use App\config\Router;

$router = new Router();
$router->run();