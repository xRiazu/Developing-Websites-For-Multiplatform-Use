<?php
include 'database/config.php';
session_start();
$BlogID = $_GET['bid'];
$UserID = $_GET['uid'];

$insertComment = $conn->prepare("INSERT INTO blog_comments (content, BlogID, UserID) VALUES (?, ?, ?)");

// Bind parameters to prevent SQL injection
$insertComment->bind_param("sii", $_POST['content'], $BlogID, $UserID);

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