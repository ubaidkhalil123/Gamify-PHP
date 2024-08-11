<?php
session_start();
include "db_connection.php"; // Your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];
    $level = $_POST['level'];
    
    // Validate course description length
    $word_count = str_word_count($course_description);
    if ($word_count > 50) {
        die("Course description should not be more than 50 words.");
    }
    
    // Prepare to handle file upload
    $upload_dir = 'uploads/pdf/'; // Directory where videos will be stored
    $upload_file = $upload_dir . basename($_FILES['video_file']['name']);
    
    // Check if file is a valid video
    $videoFileType = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
    $allowed_types = ['mp4', 'avi', 'mov', 'wmv'];
    if (!in_array($videoFileType, $allowed_types)) {
        die("Invalid file type. Please upload a video file.");
    }
    
    // Check if file upload was successful
    if (!move_uploaded_file($_FILES['video_file']['tmp_name'], $upload_file)) {
        die("File upload failed.");
    }

    // Insert course details into 'courses' table
    $insert_course_query = "INSERT INTO courses (course_name, course_description, level, upload_date) 
                            VALUES (?, ?, ?, NOW())";
    $stmt = $connection->prepare($insert_course_query);
    if (!$stmt) {
        die("Prepare failed: (" . $connection->errno . ") " . $connection->error);
    }
    $stmt->bind_param("sss", $course_name, $course_description, $level);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    $course_id = $stmt->insert_id;
    $stmt->close();

    // Insert video file details into 'course_materials' table
    $insert_video_query = "INSERT INTO course_materials (course_id, material_type, file_name, file_path) 
                           VALUES (?, 'Video', ?, ?)";
    $stmt_video = $connection->prepare($insert_video_query);
    if (!$stmt_video) {
        die("Prepare failed: (" . $connection->errno . ") " . $connection->error);
    }
    $stmt_video->bind_param("iss", $course_id, $_FILES['video_file']['name'], $upload_file);
    if (!$stmt_video->execute()) {
        die("Execute failed: (" . $stmt_video->errno . ") " . $stmt_video->error);
    }
    $stmt_video->close();

    // Redirect to a success page or back to admin panel
    header("Location: admin_dashboard.php");
    exit();
}
?>
