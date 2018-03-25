<?php
ob_start();

//database credentials & other configs
$GLOBALS['config'] = array(
    'mysqli'       => array(
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'db'       => 'college',
        'base_url' => 'http://localhost/sample/'
    ));

spl_autoload_register(function($class) {
    require_once '../websites/' . $class . '.php';
});
?>