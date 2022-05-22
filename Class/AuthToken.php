<?php
require_once "Models/Token.php";
require_once "Models/User.php";

class AuthToken {
    private $user;
    private $psw;

    public function __construct($headers=['user'=>null,'psw'=>null])
    {
        if($this->verificarHeadersEnServer($headers)) {
            $this->user = $_SERVER[$headers['user']];
            $this->psw  = $_SERVER[$headers['psw']];
        }
        else {
            die('No existen esos encabezados en $_SERVER');
        }
    }

    public function verificarCredencialesEnDB() {
        
    }

    public function verificarMetodoHTTP() {
        switch($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                break;
            case 'POST':
                break;
            default:
                die;
        };
    }

    public function get() {

    }

    public function post() {

    }

    public function run() {

    }

    public function getUser() {
        return $this->user;
    }

    public function getPsw() {
        return $this->psw;
    }

    public function verificarHeadersEnServer($headers) {
        if(array_key_exists($headers['user'], $_SERVER) && array_key_exists($headers['psw'], $_SERVER)) {
            return true;
        }
        else {
            return false;
        }
    }
}