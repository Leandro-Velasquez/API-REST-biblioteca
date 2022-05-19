<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

require_once "autoload.php";

$url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

if(array_shift($url) == "api") {
    $service = ucfirst(array_shift($url)) . 'Service';
    $method = $_SERVER['REQUEST_METHOD'];

    switch(strtoupper($method)) {
        case 'GET':
            $obj = new $service;
            call_user_func_array(array($obj, strtolower($method)), $url);
            break;
        case 'POST':
            $json = json_decode(file_get_contents('php://input'), true);
            $obj = new $service;
            call_user_func_array(array($obj, strtolower($method)), array($json));
            break;
        case 'PUT':
            break;
        case 'DELETE':
            break;
    }
}