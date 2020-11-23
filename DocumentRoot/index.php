<?php
/**
 * @file
 * The PHP page that serves all page requests on a site.
 */
require './config/environment.php';
require './vendor/autoload.php';
session_start();

use App\config\Router;

$router = new Router();
$router->run();
