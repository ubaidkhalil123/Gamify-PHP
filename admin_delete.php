<?php
// Include database connection
include "db_connection.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM academic_register WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: admin_manage_user.php");
    } else {
        die("Delete failed: " . $stmt->error);
    }
    $stmt->close();
} else {
    die("ID not provided.");
}
?>
