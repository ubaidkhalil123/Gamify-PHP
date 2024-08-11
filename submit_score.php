<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include "db_connection.php";

// Fetch user ID from session
$user_id = $_SESSION['user_id']; // Ensure this is set after login

// Debugging output
if (!isset($user_id)) {
    die('User ID not set in session.');
}

// Fetch the total score from the quiz submission
$total_score = isset($_POST['totalScore']) ? intval($_POST['totalScore']) : 0;

// Validate total score
if ($total_score < 0) {
    die('Invalid score.');
}

// Insert the result into tbl_result without year_section
$stmt = $connection->prepare('INSERT INTO tbl_result (quiz_taker, total_score, date_taken) VALUES (?, ?, NOW())');
if (!$stmt) {
    die('Prepare failed: ' . htmlspecialchars($connection->error));
}

$stmt->bind_param('ii', $user_id, $total_score);
if (!$stmt->execute()) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

// Fetch current XP and level
$stmt = $connection->prepare('SELECT xp, level FROM users WHERE user_id = ?');
if (!$stmt) {
    die('Prepare failed: ' . htmlspecialchars($connection->error));
}
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $current_xp = $user['xp'];
    $current_level = $user['level'];
    
    // Calculate new XP and level
    $new_xp = $current_xp + $total_score;
    $new_level = $current_level; // You might want to update this based on XP thresholds

    // Example level-up logic (replace with your own logic)
    if ($new_xp >= 100) {
        $new_level = 2; // Example level up
    }

    // Update the users table with new XP and level
    $stmt = $connection->prepare('UPDATE users SET xp = ?, level = ? WHERE user_id = ?');
    if (!$stmt) {
        die('Prepare failed: ' . htmlspecialchars($connection->error));
    }
    $stmt->bind_param('iii', $new_xp, $new_level, $user_id);
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    echo "Quiz results saved and XP/Level updated.";
} else {
    die('User not found in the database.');
}

header("Location: take-quiz-question.php"); // Redirect to results page
exit();
?>

