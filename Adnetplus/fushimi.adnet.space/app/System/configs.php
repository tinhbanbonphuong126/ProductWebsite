<?php

/*
---------------------------------------------------------------
+	Application URL  +
---------------------------------------------------------------
*/
define('APP_URL', 'http://fushimi.adnet.space/');
define('STATIC_URL', APP_URL . 'public/');

/*
---------------------------------------------------------------
+	Application directories  +
---------------------------------------------------------------
*/
define('BASE_DIR', dirname(realpath(__FILE__)) . '/../../');

define('APP_DIR', BASE_DIR . 'app/');
define('MODEL_DIR', APP_DIR . 'Models/');
define('VIEW_DIR', APP_DIR . 'Views/');
define('CONTROLLER_DIR', APP_DIR . 'Controllers/');
define('REPOSITORY_DIR', APP_DIR . 'Repositories/');
define('SYSTEM_DIR', APP_DIR . 'System/');

define('PUBLIC_DIR', BASE_DIR . 'public/');
define('UPLOAD_DIR', PUBLIC_DIR . 'uploads/');

/*
---------------------------------------------------------------
+	Database connection  +
---------------------------------------------------------------
*/
define('DB_HOST', 'localhost');		//host name
define('DB_NAME', 'adplus_fushimi');//database name
define('DB_USER', 'adplus_fushimi');//user
define('DB_PASS', 'fushimi2017');	//password
define('DB_PORT', '3306');			//connection  port

/*
---------------------------------------------------------------
+	Pagination  +
---------------------------------------------------------------
*/
define('PER_PAGE', 7);