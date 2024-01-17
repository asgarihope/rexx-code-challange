<?php

use core\Database;
use core\Router;

require_once __DIR__ . '/vendor/autoload.php';

require_once 'core/Router.php';
require_once 'core/Database.php';
require_once 'src/Controller/HomeController.php';

$db = (new Database())->connect();

$router = new Router();

$router->addRoute('', HomeController::class, 'index');
$router->addRoute('/upload-json', FileUploadController::class, 'uploadJson');

$router->addRoute('about', HomeController::class, 'about');


$uri = trim($_SERVER['REQUEST_URI'], '/');
$uri = trim($_SERVER['REQUEST_URI'], '/');

$router->route($uri, $db);