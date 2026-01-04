<?php 

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'herald_db';

try {

    $pdo = new PDO(
        "mysql:host=$server;dbname=$database;charset=utf8mb4",$username,$password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    echo "<h3 style='color:green;'>Welcome to Student Database!</h3>";

} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}

?>