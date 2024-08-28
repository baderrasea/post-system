<?php
session_start();
include("php/config.php");

// Check if user is logged in
if (!isset($_SESSION['valid'])) {
    header("Location: signin.php");
    exit();
}

// Get the post ID from the URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the post data from the database
$stmt = $con->prepare("SELECT * FROM posts WHERE id = ? AND UserId = ?");
$stmt->bind_param("ii", $post_id, $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "Post not found or you don't have permission to edit it.";
    exit();
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $media_type = $_POST['media_type'];
    $media_path = $_POST['media_path'];

    // Update the post in the database
    $stmt = $con->prepare("UPDATE posts SET title = ?, content = ?, media_type = ?, media_path = ? WHERE id = ? AND UserId = ?");
    $stmt->bind_param("ssssii", $title, $content, $media_type, $media_path, $post_id, $_SESSION['id']);
    
    if ($stmt->execute()) {
        echo "<div class='message'><p>Post updated successfully!</p></div>";
    } else {
        echo "<div class='message'><p>Error updating post. Please try again.</p></div>";
    }

    $stmt->close();
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class="container">
    <div class="box form-box">
        <header>Edit Post</header>
        <form action="" method="post">
            <div class="field input">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>

            <div class="field input">
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>

            <div class="field input">
                <label for="media_type">Media Type</label>
                <select name="media_type" id="media_type" required>
                    <option value="image" <?php echo $post['media_type'] == 'image' ? 'selected' : ''; ?>>Image</option>
                    <option value="video" <?php echo $post['media_type'] == 'video' ? 'selected' : ''; ?>>Video</option>
                    <option value="audio" <?php echo $post['media_type'] == 'audio' ? 'selected' : ''; ?>>Audio</option>
                    <option value="file" <?php echo $post['media_type'] == 'file' ? 'selected' : ''; ?>>File</option>
                </select>
            </div>

            <div class="field input">
                <label for="media_path">Media Path</label>
                <input type="text" name="media_path" id="media_path" value="<?php echo htmlspecialchars($post['media_path']); ?>" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Update Post">
            </div>
            <a href="my_posts.php" class="btn">Back to Posts</a>
        </form>
    </div>
</div>
</body>
</html>
