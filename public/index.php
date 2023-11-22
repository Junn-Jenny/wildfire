<?php
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH .'/vendor/autoload.php';
require BASE_PATH . 'Core/functions.php';

require base_path('bootstrap.php');

$router = new \Core\Router();

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($uri, $method);