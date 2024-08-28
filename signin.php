<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
                include("php/config.php");
                if(isset($_POST['submit'])){
                    $email = mysqli_real_escape_string($con, $_POST['email']);
                    $password = mysqli_real_escape_string($con, $_POST['password']);

                    // Use a prepared statement to fetch the user's data based on email
                    $stmt = $con->prepare("SELECT * FROM users WHERE Email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();

                    if(is_array($row) && !empty($row)){
                        // Verify the hashed password
                        if (password_verify($password, $row['Password'])) {
                            $_SESSION['valid'] = $row['Email'];
                            $_SESSION['username'] = $row['Username'];
                            $_SESSION['age'] = $row['Age'];
                            $_SESSION['id'] = $row['Id'];
                            $_SESSION['role'] = $row['roles'];

                            if($_SESSION['role'] ==1)
                            header("Location: admin_dashboard.php");

                            else

                            header("Location: index.php");
                            exit();
                        } else {
                            echo "<div class='message'><p>Wrong Username or Password</p></div> <br>";
                            echo "<a href='signin.php'><button class='btn'>Go Back</button>";
                        }
                    } else {
                        echo "<div class='message'><p>Wrong Username or Password</p></div> <br>";
                        echo "<a href='signin.php'><button class='btn'>Go Back</button>";
                    }

                    $stmt->close();
                    $con->close();
                } else {
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>
