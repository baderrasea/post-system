// update_user.php
<?php
header('Content-Type: application/json');
include("php/config.php");


$user_id = $_POST['id'];
$username = $_POST['Username'];
$email = $_POST['Email'];
$role = $_POST['roles'];

$sql = "UPDATE users SET Username = ?, email = ?, role = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $username, $email, $role, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "User updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error updating user: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
