<?php
require_once "Models/Book.php";

class BooksService {

    public function get($id = null) {
        $books = !empty($id) ? Book::selectById($id): Book::selectAll();
        header('Content-type: application/json');
        echo json_encode($books);
    }

    public function post($data = null) {
        Book::addBook($data);
        echo Book::getIdLastBookAdd()['id_libro'];
    }

    public function put($data = null) {
        Book::updateBook($data);
        echo "Los datos del libro fueron editados.";
    }

    public function delete($id) {
        Book::deleteBook($id);
        echo "El libro fue eliminado de la base de datos";
    }
}
?>