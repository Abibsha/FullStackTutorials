<?php
include '../includes/header.php';

$file = __DIR__ . '/../data/students.txt';

echo '<h2>Student List</h2>';

if (!file_exists($file)) {
	echo '<p>No students found.</p>';
	include '../includes/footer.php';
	exit;
}

$lines = file($file);

echo '<ul>';
foreach ($lines as $line) {
	list($name, $email, $skills) = explode('|', trim($line));
	$skillsArray = explode(',', $skills);

	echo '<li>';
	echo "<strong>Name:</strong> $name<br>";
	echo "<strong>Email:</strong> $email<br>";
	echo "<strong>Skills:</strong>";
	echo '<ul>';
	foreach ($skillsArray as $skill) {
		echo "<li>$skill</li>";
	}
	echo '</ul>';
	echo '</li><hr>';
}
echo '</ul>';

include '../includes/footer.php';
