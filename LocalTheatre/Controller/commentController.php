<?php
include 'Database/config.php';
session_start();
$BlogID = $_GET['BlogID'];
$UserID = $_GET['UserID'];

$insertComment = $conn->prepare("INSERT INTO blog_comments (CommentCreated, BlogID, UserID) VALUES (?, ?, ?)");

// Bind parameters to prevent SQL injection
$insertComment->bind_param("sii", $_POST['CommentCreated'], $BlogID, $UserID);

// Execute the query
if ($insertComment->execute()) {
    $_SESSION['status_message'] = "Comment added successfully!";
} else {
    $_SESSION['status_message'] = "Error: " . $conn->error;
}

// Close statement
$insertComment->close();
        
    

    // Redirect back to the blog page
    header("Location: blogInfo?bid=" . $BlogID);
    exit();