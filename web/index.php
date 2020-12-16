<?php
/**
 * @file
 * The PHP page that serves all page requests on a site.
 */
ini_set('session.cookie_httponly', 1);
require './environment.php';
require './vendor/autoload.php';
session_start();

use App\config\Router;

$router = new Router();
$router->run();
