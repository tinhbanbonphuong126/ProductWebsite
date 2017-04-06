<?php

require_once '../app/System/bootstrap.php';

use \App\System\UrlParser;

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = isset($_GET['r']) ? $_GET['r'] : '/';
$urlParsers = new UrlParser($requestMethod, $requestUri);
$method = $urlParsers->getAction();
$controller = $urlParsers->getController();
(new $controller())->$method();
