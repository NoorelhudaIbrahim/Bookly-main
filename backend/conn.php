<?php

header("Access-Control-Allow-Origin: *");

$dbsn = "localhost";
$dbun = "root";
$password = "";
$dbname = "bookly";

$dsn ="mysql:host=$dbsn;dbname=$dbname";

$pdo = new PDO($dsn,$dbun,$password);


?>