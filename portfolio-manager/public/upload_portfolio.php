<?php
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['portfolio'])) {
	try {
		$file = $_FILES['portfolio'];
		$allowed = ['pdf', 'jpg', 'jpeg', 'png'];
		$maxSize = 2 * 1024 * 1024;

		if ($file['error'] !== UPLOAD_ERR_OK) {
			throw new Exception('File upload error.');
		}

		$originalName = $file['name'];
		$ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

		if (!in_array($ext, $allowed)) {
			throw new Exception('Invalid file format. Only PDF, JPG, and PNG are allowed.');
		}

		if ($file['size'] > $maxSize) {
			throw new Exception('File size exceeds 2MB limit.');
		}

		$uploadDir = __DIR__ . '/../uploads/';

		if (!is_dir($uploadDir)) {
			if (!mkdir($uploadDir, 0777, true)) {
				throw new Exception('Failed to create upload directory.');
			}
		}

		if (!is_writable($uploadDir)) {
			throw new Exception('Upload directory is not writable.');
		}

		$baseName = pathinfo($originalName, PATHINFO_FILENAME);
		$baseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $baseName);
		$newName = strtolower($baseName) . '_' . time() . '.' . $ext;
		$targetPath = $uploadDir . $newName;

		if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
			throw new Exception('Failed to save file.');
		}

		$success = 'File uploaded successfully!';
	} catch (Exception $e) {
		$error = $e->getMessage();
	}
}
?>

<?php include '../includes/header.php'; ?>
<section class="mid-section">
	<form method="POST" enctype="multipart/form-data">
		<input id="upload-portfolio" type="file" name="portfolio" accept=".pdf,.jpg,.jpeg,.png">
		<button type="submit">Upload</button>
		<?php if ($error): ?>
			<p class="error"><?php echo htmlspecialchars($error); ?></p>
		<?php endif; ?>
		<?php if ($success): ?>
			<p class="success"><?php echo htmlspecialchars($success); ?></p>
		<?php endif; ?>
	</form>
</section>
<?php include '../includes/footer.php'; ?>
