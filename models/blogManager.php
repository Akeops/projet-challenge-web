<?php
require './models/connection.php';

class Blog {

function getBlogs(): array {
    $sql = "SELECT * FROM blog";
    $query = dbConnect()->prepare($sql);
    $query->fetchAll(PDO::FETCH_ASSOC);
    $query->execute();
    $blogs = $query->fetchAll();
    $query->closeCursor();
    return $blogs;
}

  // Retourne un article en fonction de l'id reçu
function getBlogByID(int $id): array {
    $sql = "SELECT * FROM blog where id = :id;";
    $query = dbConnect()->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $blogs = $query->fetch();
    $query->closeCursor();
    return $blogs;
  }
}