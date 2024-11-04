<?php
require 'vendor/autoload.php';
require 'Core/core.php';

use App\Classes\Handler;
use Core\Cache\Base\Cache;
use DeadalusPHP\Router\Router;

define('PROCESS_START', microtime(true));
ini_set('display_errors', false);

$cache = new Cache();
$router = new Router();
$handler = new Handler();

try {
    $handler->terminate(function () use ($router) {
        return $router->callAction();
    });

} catch (Exception $e) {
    $handler->log([
        'message' => $e->getMessage(),
        'code' => $e->getCode(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
    return response()->error($e->getMessage())->send();
} catch (\Error $e) {
    $handler->log([
        'message' => $e->getMessage(),
        'code' => $e->getCode(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
    return response()->error($e->getMessage())->send();
}


