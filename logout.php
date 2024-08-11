<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page or homepage
header("Location: index.php"); // or any other page like 'index.php'
exit();
?>
                            
