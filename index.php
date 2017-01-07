<?php

// Note, the script requires PHP 5.5 or higher
require_once 'core/Error.php';
error_reporting(E_ALL);
set_error_handler('app\core\Error::errorHandler');
set_exception_handler('app\core\Error::exceptionHandler');

require_once 'Config.php';
require_once 'core/Model.php';
require_once 'core/View.php';
require_once 'core/Controller.php';
require_once 'core/Route.php';
require_once 'core/_autoload.php';

app\core\Route::run();


