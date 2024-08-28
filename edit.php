<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
       header("Location: signin.php");
       exit(); // It's a good practice to exit after a redirect
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Change Profile</title>
</head>
<body>
   
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                   $username = $_POST['username'];
                   $email = $_POST['email'];
                   $age = $_POST['age'];
                   $password = $_POST['password'];

                   $id = $_SESSION['id'];

                   // Prepare to update password if provided
                   if (!empty($password)) {
                       $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                       $edit_query = $con->prepare("UPDATE users SET Username = ?, Email = ?, Age = ?, Password = ? WHERE Id = ?");
                       $edit_query->bind_param("ssisi", $username, $email, $age, $hashed_password, $id);
                   } else {
                       $edit_query = $con->prepare("UPDATE users SET Username = ?, Email = ?, Age = ? WHERE Id = ?");
                       $edit_query->bind_param("ssii", $username, $email, $age, $id);
                   }

                   if($edit_query->execute()){
                       echo "<div class='message'>
                               <p>Profile Updated!</p>
                             </div> <br>";
                             
                        if($_SESSION['role'] ==1)
                        echo "<a href='admin_dashboard.php'><button class='btn'>Go Home</button>";

                            else

                            echo "<a href='index.php'><button class='btn'>Go Home</button>";
                        } else {
                       echo "<div class='message'>
                               <p>Error occurred while updating profile.</p>
                             </div> <br>";
                       echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                   }
                   
                   $edit_query->close();

               } else {
                   $id = $_SESSION['id'];

                   $query = $con->prepare("SELECT Username, Email, Age FROM users WHERE Id = ?");
                   $query->bind_param("i", $id);
                   $query->execute();
                   $query->bind_result($res_Uname, $res_Email, $res_Age);
                   $query->fetch();
                   $query->close();
            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($res_Uname); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($res_Email); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($res_Age); ?>" autocomplete="off" required>
                </div>
                
                <div class="field input">
                    <label for="password">New Password (Leave blank to keep current password)</label>
                    <input type="password" name="password" id="password" autocomplete="off">
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>
