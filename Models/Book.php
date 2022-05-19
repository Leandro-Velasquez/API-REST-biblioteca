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

    public static function selectAll() {
        $sql = 'SELECT * FROM ' . self::$table;

        $stmt = Db::connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addBook($data) {
        $sql = 'INSERT INTO ' . self::$table . ' (nombre, autor, imagen) VALUES (?, ?, ?)';

        $stmt = Db::connect()->prepare($sql);
        $stmt->execute(array($data['nombre'], $data['autor'], $data['imagen']));
    }
}
?>