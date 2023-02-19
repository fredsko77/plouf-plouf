<?php

require_once('vendor/autoload.php');
require_once('config_global.php');
require_once('functions.php');

use Core\File\FileException;

function display(string $path)
{
    if (!file_exists(APP_ERRORS_DIR . "{$path}.php")) {
        throw new FileException(APP_ERRORS_DIR . "{$path}.php");
    }
}

try {
    display('toto');
} catch (FileException $e) {
    if (defined('APP_ENV') && APP_ENV !== 'dev') {
        echo 'page d\'erreur de prod';
    } else {
        echo $e->getMessage();
    }
} 
// dd(file_exists(APP_TEMPLATE_DIR . 'index.php'));
