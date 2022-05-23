<?php
require_once "Db.php";

class Token {
    public static $table = 'tokens';

    public static function getToken($token) {
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE token=?';
        $stmt = Db::connect()->prepare($sql);
        $stmt->execute(array($token));

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function generateToken($id, $user) {
        return sha1($id . $user. time());
    }
}