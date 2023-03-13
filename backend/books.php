<?php

require_once 'conn.php';

// Create
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_REQUEST['title'];
    $author = $_REQUEST['author'];
    $description = $_REQUEST['description'];
    $cover_image = $_REQUEST['cover_image'];
    $user_id = $_REQUEST['user_id'];

    $stmt = $pdo->prepare("INSERT INTO books (title, author, description, cover_image, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $author, $description, $cover_image, $user_id]);

    // header("Location: /books.php");
}

// Read
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);}

// Update
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $put_vars);

    $id = $put_vars['id'];
    $title = $put_vars['title'];
    $author = $put_vars['author'];
    $description = $put_vars['description'];
    $cover_image = $put_vars['cover_image'];
    $user_id = $put_vars['user_id'];

    $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, description = ?, cover_image = ?, user_id = ? WHERE id = ?");
    $stmt->execute([$title, $author, $description, $cover_image, $user_id, $id]);

    header("Content-type: application/json");
    echo json_encode(["message" => "Book updated"]);
}

// Delete
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $delete_vars);

    $id = $delete_vars['id'];

    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$id]);

    header("Content-type: application/json");
    echo json_encode(["message" => "Book deleted"]);
}
