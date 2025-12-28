<?php
require 'db.php';

$sql = "SELECT * FROM students";
$stmt = $pdo->query($sql);
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Student Database</title>
	<style>
		table { border-collapse: collapse; width: 70%; }
		th, td { border: 1px solid #000; padding: 8px; text-align: center; }
	</style>
</head>
<body>

<h1>Student's List:</h1>
<a href="create.php">Add New Student</a><br><br>

<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Course</th>
		<th>Actions</th>
	</tr>

	<?php foreach($students as $student): ?>
	<tr>
		<td><?= $student['id']; ?></td>
		<td><?= $student['name']; ?></td>
		<td><?= $student['email']; ?></td>
		<td><?= $student['course']; ?></td>
		<td>
			<a href="update.php?id=<?= $student['id']; ?>">Edit</a> |
			<a href="delete.php?id=<?= $student['id']; ?>" 
			   onclick="return confirm('Are you sure?')">Delete</a>
		</td>
	</tr>
	<?php endforeach; ?>

</table>

</body>
</html>
