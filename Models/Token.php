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

    public static function saveToken($idUser, $token) {
        $sql = 'INSERT INTO ' . self::$table . '(token, id_user) VALUES (?, ?)';
        $stmt = Db::connect()->prepare($sql);

        $stmt->execute(array($token, $idUser));
    }

    public static function generateToken($id, $user) {
        return sha1($id . $user. time());
    }
}