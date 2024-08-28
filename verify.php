<?php
include("php/config.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $con->prepare("SELECT Id FROM users WHERE Token = ? AND verified = FALSE");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $update_stmt = $con->prepare("UPDATE users SET verified = TRUE, Token = '' WHERE Token = ?");
        $update_stmt->bind_param("s", $token);
        $update_stmt->execute();

        echo "<div class='message'>
                <p>Email verified successfully! You can now log in.</p>
              </div> <br>";
        echo "<a href='signin.php'><button class='btn'>Login Now</button>";
    } else {
        echo "<div class='message'>
                <p>Invalid or expired token!</p>
              </div> <br>";
        echo "<a href='signin.php'><button class='btn'>Login</button>";
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: signin.php");
    exit();
}
?>
