<?php
include '../includes/header.php';

$error = '';
$success = '';

function formatName($name) {
	return ucwords(trim($name));
}

function validateEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
	$skills = explode(',', $string);
	return array_map('trim', $skills);
}

function saveStudent($name, $email, $skillsArray) {
	$file = __DIR__ . '/../data/students.txt';
	$data = $name . '|' . $email . '|' . implode(',', $skillsArray) . PHP_EOL;

	if (!file_put_contents($file, $data, FILE_APPEND)) {
		throw new Exception('Failed to save student data.');
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	try {
		$name = formatName($_POST['name'] ?? '');
		$email = $_POST['email'] ?? '';
		$skillsInput = $_POST['skills'] ?? '';

		if (empty($name) || empty($email) || empty($skillsInput)) {
			throw new Exception('All fields are required.');
		}

		if (!validateEmail($email)) {
			throw new Exception('Invalid email format.');
		}

		$skillsArray = cleanSkills($skillsInput);
		saveStudent($name, $email, $skillsArray);

		$success = 'Student added successfully!';
	} catch (Exception $e) {
		$error = $e->getMessage();
	}
}
?>

<h2>Add Student</h2>

<form method="POST">
	<label>Name:</label><br>
	<input type="text" name="name"><br><br>

	<label>Email:</label><br>
	<input type="text" name="email"><br><br>

	<label>Skills (comma separated):</label><br>
	<input type="text" name="skills"><br><br>

	<button type="submit">Save Student</button>
</form>

<?php if ($error): ?>
	<p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if ($success): ?>
	<p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
