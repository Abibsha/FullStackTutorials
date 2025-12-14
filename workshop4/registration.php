<?php

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get form data
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";

    if ($name === "") {
        $errors[] = "Name is required.";
    }

    if ($email === "") {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if ($password === "") {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {

        $file = "users.json";

        // Read existing users
        if (file_exists($file)) {
            $jsonData = file_get_contents($file);
            $users = json_decode($jsonData, true);

            if (!is_array($users)) {
                $users = [];
            }
        } else {
            $users = [];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $newUser = [
            "name" => $name,
            "email" => $email,
            "password" => $hashedPassword
        ];

        $users[] = $newUser;

        if (file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT))) {
            $success = "Registration successful!";
        } else {
            $errors[] = "Error saving data.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Registration Status</h1>

    <?php if (!empty($errors)) : ?>
        <?php foreach ($errors as $error) : ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($success !== "") : ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <a href="index.html">Go Back</a>
</div>

</body>
</html>
