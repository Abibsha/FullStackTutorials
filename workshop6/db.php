<?php 
$server = "localhost";
$database = "school_db";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$server;dbname=$database", $username, $password);   
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "<h3 style='color:green;'>Welcome to student Database!</h3>";
} catch (PDOException $e) {
    die("Unable to connect to database: " . $e->getMessage());
}
?>