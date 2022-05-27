<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

require_once "autoload.php";
/*require_once "Class/AuthToken.php";
$headers = [
    'user'=>'HTTP_X_USER',
    'psw'=>'HTTP_X_PSW',
    'token' => 'HTTP_X_TOKEN',
];
(new AuthToken($headers))->run();*/
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
            $data = json_decode(file_get_contents('php://input'), true);
            $obj = new $service;
            call_user_func_array(array($obj, strtolower($method)), array($data));
            break;
        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            if($data['id_libro']) {
                $obj = new $service;
                call_user_func_array(array($obj, strtolower($method)), array($data));
            }else {
                echo "Error al intentar modificar el recurso, id invalido.";
            }
            break;
        case 'DELETE':
            $data = json_decode(file_get_contents('php://input'), true);
            if($data['id_libro']) {
                $obj = new $service;
                call_user_func_array(array($obj, strtolower($method)), array($data));
            }else {
                echo "Error al intentar eliminar el recurso, id invalido.";
            }
            break;
    }
}