>

<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "db_mosnad";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session to access the user ID
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
    die("Unauthorized access.");
}

// Get user ID from the session
$userId = $_SESSION['id'];

$title = $_POST['title'];
$content = $_POST['content'];
$media_type = '';
$media_path = '';

// Handle file upload
if ($_FILES['media']['name']) {
    $file_name = $_FILES['media']['name'];
    $file_tmp = $_FILES['media']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        $media_type = 'image';
    } elseif (in_array($file_ext, ['mp4', 'avi', 'mov'])) {
        $media_type = 'video';
    } elseif (in_array($file_ext, ['mp3', 'wav', 'ogg'])) {
        $media_type = 'audio';
    } else {
        $media_type = 'file';
    }

    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $media_path = $upload_dir . basename($file_name);
    move_uploaded_file($file_tmp, $media_path);
}

// Prepare SQL query with UserId
$sql = "INSERT INTO posts (title, content, media_type, media_path, UserId) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $title, $content, $media_type, $media_path, $userId);

if ($stmt->execute()) {
    echo "New post created successfully";
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
