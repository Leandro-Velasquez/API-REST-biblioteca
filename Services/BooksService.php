<?php
require_once "Models/Book.php";

class BooksService {

    public function get($id = null) {
        $books = !empty($id) ? Book::selectById($id): null;
        echo json_encode($books);
    }

    public function post() {

    }

    public function put() {

    }

    public function delete() {

    }
}
?>