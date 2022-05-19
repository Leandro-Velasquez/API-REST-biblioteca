<?php
require_once "Models/Book.php";

class BooksService {

    public function get($id = null) {
        $books = !empty($id) ? Book::selectById($id): Book::selectAll();
        echo json_encode($books);
    }

    public function post($data = null) {
        Book::addBook($data);
        echo "El libro fue agregado.";
    }

    public function put() {

    }

    public function delete() {

    }
}
?>