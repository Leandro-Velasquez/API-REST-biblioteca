<?php
require_once "Db.php";

class Token {

    public static function generateToken($id, $user) {
        return sha1($id . $user. time());
    }
}