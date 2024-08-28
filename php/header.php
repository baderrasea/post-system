<div class="nav">
    <div class="logo">
        <a href="index.php">Logo</a>
    </div>

    <div class="right-links">
        <?php 
        $id = $_SESSION['id'];
        $query = mysqli_query($con, "SELECT * FROM users WHERE Id = $id");
        while ($result = mysqli_fetch_assoc($query)) {
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $res_Age = $result['Age'];
            $res_id = $result['Id'];
        }
        echo "<a href='edit.php?Id=$res_id' class='link'>Change Profile</a>";
        ?>
        <a href="my_posts.php"><button class="btn">my post</button></a>
        <a href="new_post.php"><button class="btn"> add post</button></a>
        <a href="php/logout.php"><button class="btn" style="background-color: red;">Log Out</button></a>
    </div>
</div>

