<?php

require 'db.php';

if($_SERVER['REQUEST_METHOD']==="POST"&&isset($_POST['add_student'])){
	$student_id = $_POST['student_id']??'';
	$name = $_POST['name']??'';
	$password = $_POST['password']??'';
	$table_name = "students";

	$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
	$sql = "INSERT INTO $table_name (student_id, full_name, password_hash)
			VALUES (?,?,?)";
	
	try{
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$student_id,$name,$hashedPassword]);
		echo "Student added successfully.";
		header("Refresh:1, url=login.php");
	}catch(PDOException $e){
		die("Unable to add student due to database error: ".$e->getMessage());
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Registration</title>
</head>
<body>
	<h1>User Registration</h1>
	<form method="POST">
		Student Id: <input type="text" name="student_id" required><br>
		Name: <input type="text" name="name" required><br>
		Password: <input type="password" name="password" required><br>
		<button type="submit" name="add_student">Add Student</button>
	</form>

</body>
</html>
