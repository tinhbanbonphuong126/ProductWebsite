<?php

session_start();

// require all system files
require 'configs.php';
require 'Route.php';
require 'UrlParser.php';
require 'Request.php';
require 'Response.php';
require 'Session.php';
require 'autoload.php';
require 'helpers.php';

// global variable for containing all routes
$routes = [];
require APP_DIR . 'routes.php';

// user defined functions
require APP_DIR . 'helpers.php';