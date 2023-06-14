<?php
session_start();
ini_set('memory_limit', '2048M');
ini_set('max_execution_time', 1800);
ini_set('php_value post_max_size', 200);

require 'vendor/autoload.php';
require 'config.php';

spl_autoload_register(function ($class){
    if(file_exists('controllers/'.$class.'.php')) {
            require_once 'controllers/'.$class.'.php';
    } elseif(file_exists('models/'.$class.'.php')) {
            require_once 'models/'.$class.'.php';
    } elseif(file_exists('core/'.$class.'.php')) {
            require_once 'core/'.$class.'.php';
    }
});

$core = new Core();
$core->run();
?>
