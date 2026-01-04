<?php
require 'db.php';

if($_SERVER['REQUEST_METHOD']==="POST"&&isset($_POST['login'])){
	$student_id = $_POST['student_id'];
	$password = $_POST['password'];
	$table_name = "students";

	$sql = "SELECT * FROM $table_name WHERE student_id = ?";

	try{
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$student_id]);
		$student = $stmt->fetch();
		if($student){
			$hashedPassword = $student['password_hash'];
			$isPasswordValid = password_verify($password, $hashedPassword);
			if($isPasswordValid){
				session_start();
				$_SESSION['logged_in']=true;
				$_SESSION['username']=$student['full_name'];
				
				header("Refresh:1, url=dashboard.php");

			}else{
				echo "Invalid Password! Please try again.";
			}
		}else{
			echo"Invalid Student Id.";
		}
	}catch(PDOException $e){
		die("Database Error: ".$e->getMessage());
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Login</title>
</head>
<body>
	<h1>Login Here!</h1>
	<form method="POST">
		Student Id: <input type="text" name="student_id" required><br>
		Password: <input type="password" name="password" required><br>
		<button type="submit" name="login">Login</button>
	</form>
</body>
</html>