<?php
require 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
	die("Student ID not found");
}

$sql = "DELETE FROM students WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
exit;
