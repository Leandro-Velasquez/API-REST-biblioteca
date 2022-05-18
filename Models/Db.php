<?php

class Db {

    public static function connect() {
        try {
            $connect = new PDO('mysql:host=localhost;dbname=biblioteca', 'root', '');

            return $connect;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }
}