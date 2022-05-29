<?php
require_once "Models/Book.php";

class BooksService {

    public function get($id = null) {
        $books = !empty($id) ? Book::selectById($id): Book::selectAll();
        header('Content-type: application/json');
        echo json_encode($books);
    }

    public function post() {
        $dir_subida = 'Images/uploads/';
        $imagen_subida = $dir_subida . basename($_FILES['file']['name']);

        $data = array('nombre' => $_POST['nombre'], 'autor' => $_POST['autor'], 'imagen' => $dir_subida);
        if(move_uploaded_file($_FILES['file']['tmp_name'], $imagen_subida)) {
            Book::addBook($data);
            $json = array('id' => Book::getIdLastBookAdd()['id_libro'], 'nombre' => $_POST['nombre'], 'autor' => $_POST['autor'], 'imagen' => $_FILES['file']['name']);
            echo json_encode($json);
        }
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