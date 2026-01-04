<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

$theme = $_COOKIE['theme'] ?? 'light';

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>

    <style>
        body {
            background-color: <?= ($theme === 'dark') ? '#000' : '#fff' ?>;
            color: <?= ($theme === 'dark') ? '#fff' : '#000' ?>;
            font-family: Arial;
        }
        a, button {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h1>Welcome <?= $_SESSION['username'] ?></h1>

    <nav>
        <a href="preference.php">Change Theme</a>
        <a href="dashboard.php?logout=true">Logout</a>
    </nav>
</body>
</html>
