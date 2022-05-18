<?php
require_once "Db.php";

class Book {
    public static $table = 'libros';

    public static function selectById($id) {
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id_libro = ?';

        $stmt = Db::connect()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>