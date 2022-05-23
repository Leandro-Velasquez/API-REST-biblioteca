<?php
require_once "Models/Token.php";
require_once "Models/User.php";

class AuthToken {
    private $user;
    private $psw;
    private $headers;
    private $method;
    private $token;

    public function __construct($headers=['user'=>null,'psw'=>null])
    {
        $this->headers = $headers;
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function verificarHeadersEnServerUserPsw() {
        if(array_key_exists($this->headers['user'], $_SERVER) && array_key_exists($this->headers['psw'], $_SERVER)) {
            $this->user = $_SERVER[$this->headers['user']];
            $this->psw = $_SERVER[$this->headers['psw']];
            return true;
        }
        else {
            return false;
        }
    }

    public function verificarHeadersEnServerToken() {
        if(array_key_exists($this->headers['token'], $_SERVER)) {
            $this->token = $_SERVER[$this->headers['token']];
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
        switch($this->method) {
            case 'GET':
                if($this->verificarHeadersEnServerToken()) {

                }
                break;
            case 'POST':
                if($this->verificarHeadersEnServerUserPsw()) {
                    if($this->verificarCredencialesEnDB()) {
                        $this->post();
                    }
                    else {
                        die('Las credenciales son invalidas.');
                    }
                }
                else {
                    die('Los encabezados ' . $this->headers['user'] . ' y ' . $this->headers['psw']. ' no fueron enviados.');
                }
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
        Token::saveToken($dataUser['id_user'], $token);

        header('Content-type: application/json');
        echo json_encode(array('access-token'=>$token));
    }

    public function run() {
        $this->verificarMetodoHTTP();
    }

    public function getUser() {
        return $this->user;
    }

    public function getPsw() {
        return $this->psw;
    }
}