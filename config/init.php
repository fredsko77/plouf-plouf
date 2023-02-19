<?php

require_once('app.php');

if (defined('APP_TIMEZONE')) {
    ini_set('date.timezone', APP_TIMEZONE);
}

if (defined('ROOT_DIRECTORY')) {
    define('APP_TEMPLATE_DIR', ROOT_DIRECTORY . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
}

if (defined('ROOT_DIRECTORY')) {
    define('APP_ERRORS_DIR', ROOT_DIRECTORY . DIRECTORY_SEPARATOR . 'errors' . DIRECTORY_SEPARATOR);
}
