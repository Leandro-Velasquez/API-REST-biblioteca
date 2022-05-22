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

    public function verificarHeadersEnServer($headers) {
        if(array_key_exists($headers['user'], $_SERVER) && array_key_exists($headers['psw'], $_SERVER)) {
            return true;
        }
        else {
            return false;
        }
    }

    public function verificarCredencialesEnDB() {
        $data = User::getUserByUserAndPw($this->getUser(), $this->getPsw());
        if(!empty($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarMetodoHTTP() {
        switch(strtoupper($_SERVER['REQUEST_METHOD'])) {
            case 'GET':
                $this->get();
                break;
            case 'POST':
                $this->post();
                break;
            default:
                die('El metodo solicitado es invalido.');
        };
    }

    public function get() {

    }

    public function post() {
        $dataUser = User::getUserByUserAndPw($this->getUser(), $this->getPsw());
        $token = Token::generateToken($dataUser['id_user'], $dataUser['user']);

        header('Content-type: application/json');
        echo json_encode(array('access-token'=>$token));
    }

    public function run() {
        if($this->verificarCredencialesEnDB()) {
            $this->verificarMetodoHTTP();
        }
        else {
            die('Las credenciales son invalidas');
        }
    }

    public function getUser() {
        return $this->user;
    }

    public function getPsw() {
        return $this->psw;
    }
}