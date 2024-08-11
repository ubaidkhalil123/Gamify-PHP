<?php
// Include database connection
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE academic_register SET username = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }

    $stmt->bind_param("sssi", $username, $email, $hashed_password, $id);
    
    if ($stmt->execute()) {
        header("Location: admin_manage_user.php");
        exit();
    } else {
        die("Update failed: " . $stmt->error);
    }
    $stmt->close();
}
?>
