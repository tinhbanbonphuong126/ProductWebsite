<?php

function __autoload($class)
{
    $parts = explode('\\', $class);
    $fileName = end($parts);
    if (strpos($class, 'Controllers') !== false) {
        if (strpos($class, 'Admin') !== false) {
            require_once CONTROLLER_DIR . 'Admin/Controller.php';
            require_once CONTROLLER_DIR . 'Admin/'. $fileName . '.php';
        } else {
            require_once CONTROLLER_DIR . 'Controller.php';
            require_once CONTROLLER_DIR. $fileName . '.php';
        }
    } elseif (strpos($class, 'Models') !== false) {
        require_once MODEL_DIR . $fileName . '.php';
    } elseif (strpos($class, 'Repositories') !== false) {
        require_once REPOSITORY_DIR . $fileName . '.php';
    }
}