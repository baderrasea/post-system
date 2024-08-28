
<style>
    /* style.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 2em;
    color: #333;
    margin-bottom: 20px;
}

.post {
    margin-bottom: 20px;
}

.post img, .post video, .post audio {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-top: 10px;
}

.post p {
    font-size: 1.1em;
    color: #666;
    line-height: 1.6;
}

small {
    color: #888;
    display: block;
    margin-top: 10px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 20px;
    font-size: 1em;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

</style>
<?php
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "db_mosnad";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get post ID from URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch post details
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php if ($post): ?>
        <div class="post">
            <h1><?php echo htmlspecialchars($post['title']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            <?php if ($post['media_type'] == 'image'): ?>
                <img src="<?php echo htmlspecialchars($post['media_path']); ?>" alt="Image">
            <?php elseif ($post['media_type'] == 'video'): ?>
                <video controls>
                    <source src="<?php echo htmlspecialchars($post['media_path']); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php elseif ($post['media_type'] == 'audio'): ?>
                <audio controls>
                    <source src="<?php echo htmlspecialchars($post['media_path']); ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            <?php else: ?>
                <a href="<?php echo htmlspecialchars($post['media_path']); ?>" download>Download File</a>
            <?php endif; ?>
            <small>Posted on: <?php echo htmlspecialchars($post['created_at']); ?></small>
        </div>
    <?php else: ?>
        <p>Post not found.</p>
    <?php endif; ?>

    <a href="index.php"><button class="btn">Back to Posts</button></a>

    <?php $conn->close(); ?>
</div>
</body>
</html>
