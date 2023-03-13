<?php

require_once 'conn.php';

// Create
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $title = $_REQUEST['title'];
//     $author = $_REQUEST['author'];
//     $description = $_REQUEST['description'];
//     // $cover_image = $_REQUEST['cover_image'];
//     $user_id = $_REQUEST['user_id'];
//     $file = $_FILES["cover_image"];



//     $targetDir = "../src/images/";
//     $fileName = basename($file["name"]);
//     $targetPath = $targetDir . $fileName;
  
//     if (move_uploaded_file($file["tmp_name"], $targetPath)) {
//       echo "File uploaded successfully";
//         $sql = "INSERT INTO books (title ,author, description , cover_image , user_id)
//                 VALUES ( ? , ? , ? , ? , ?)" ;
//         $query = $pdo->prepare($sql);
//         $query->execute([ $title , $author , $description , $cover_image ,$fileName]);
//     } else {
//       echo "Error uploading file";
//     }



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];
    $file = $_FILES["cover_image"];

    // Validate that the uploaded file is an image
    $fileType = exif_imagetype($file["tmp_name"]);
    if ($fileType === false) {
        echo "Error: File is not an image.";
        exit;
    }

    $targetDir = "../src/images/";
    $fileName = basename($file["name"]);
    $targetPath = $targetDir . $fileName;
  
    if (move_uploaded_file($file["tmp_name"], $targetPath)) {
        echo "File uploaded successfully";
        $sql = "INSERT INTO books (title ,author, description , cover_image , user_id)
                VALUES ( ? , ? , ? , ? , ?)" ;
        $query = $pdo->prepare($sql);
        $query->execute([ $title , $author , $description , $fileName ,$user_id]);
    } else {
        echo "Error uploading file";
    }
}

// }
 // Handle image file
//  $cover_image = $_FILES['cover_image']['name'];
//  $temp_name = $_FILES['cover_image']['tmp_name'];

//  $upload_dir = 'uploads/'; // Create a directory named uploads to store images
//  move_uploaded_file($temp_name, $upload_dir . $cover_image);

//  $stmt = $pdo->prepare("INSERT INTO books (title, author, description, cover_image, user_id) VALUES (?, ?, ?, ?, ?)");
//  $stmt->execute([$title, $author, $description, $cover_image, $user_id]);

 // header("Location: /books.php");
// }
// Read

// if ($_SERVER['REQUEST_METHOD'] === 'GET'){
// $stmt = $pdo->query("SELECT * FROM books");
// $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
// }
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM books";
    $query = $pdo->prepare($sql);
    $query->execute();
    $books = $query->fetchAll(PDO::FETCH_ASSOC);
    // print_r($users);
        echo json_encode($books);
  } 

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
