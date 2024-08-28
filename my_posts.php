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
    font-size: 2.5em;
    color: #333;
    margin-bottom: 30px;
    text-align: center;
}

.posts-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Space between posts */
}

.post {
    flex: 1 1 calc(33.333% - 20px); /* Adjust to fit 3 columns with gap */
    box-sizing: border-box;
    background-color: #fafafa;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    min-height: 300px; /* Ensures posts have a minimum height */
}

.post h2 {
    font-size: 1.8em;
    color: #333;
    margin-bottom: 15px;
}

.post p {
    font-size: 1.1em;
    color: #666;
    line-height: 1.8;
    margin-bottom: 15px;
    flex-grow: 1; /* Allows content to grow and fill the space */
}

.post img, .post video, .post audio {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-top: 10px;
}

.post small {
    color: #888;
    display: block;
    margin-top: 10px;
}

.post a {
    text-decoration: none;
    color: #007bff;
}

.post a:hover {
    text-decoration: underline;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 1em;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
}

.btn:hover {
    background-color: #0056b3;
}

.btn-danger {
    background-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
}

hr {
    border: 0;
    border-top: 1px solid #ddd;
    margin: 20px 0;
}

@media (max-width: 768px) {
    .post {
        flex: 1 1 calc(50% - 20px); 
    }
}

@media (max-width: 480px) {
    .post {
        flex: 1 1 100%;
    }
}
</style>

<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "db_mosnad";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$sql = "SELECT * FROM posts WHERE UserId=".$_SESSION['id']." ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    
<h1>My Posts</h1>

<div class="container">
    <div class="posts-wrapper">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="post">
                    <h2><a href="post_detail.php?id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a></h2>
                    <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 200))); ?>...</p>
                    <?php if ($row['media_type'] == 'image'): ?>
                        <img src="<?php echo htmlspecialchars($row['media_path']); ?>" alt="Image">
                    <?php elseif ($row['media_type'] == 'video'): ?>
                        <video controls>
                            <source src="<?php echo htmlspecialchars($row['media_path']); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php elseif ($row['media_type'] == 'audio'): ?>
                        <audio controls>
                            <source src="<?php echo htmlspecialchars($row['media_path']); ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    <?php else: ?>
                        <a href="<?php echo htmlspecialchars($row['media_path']); ?>" download>Download File</a>
                    <?php endif; ?>
                    <small>Posted on: <?php echo htmlspecialchars($row['created_at']); ?></small>
                    <a href="edit_post.php?id=<?php echo htmlspecialchars($row['id']); ?>" style="color: fff;" class="btn">Edit</a>
                    <a href="delete_post.php?id=<?php echo htmlspecialchars($row['id']); ?>" style="color: fff;" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>
</div>

</body>
</html>
