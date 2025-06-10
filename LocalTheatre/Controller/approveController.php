<?php
include 'Database/config.php';
session_start();

// Ensure that the cid is sanitized or validated as an integer
$CommentID = isset($_GET['CommentID']) ? (int) $_GET['CommentID'] : 0;

    // Prepare the statement with a placeholder
<<<<<<< HEAD
    $approve = $conn->prepare("UPDATE blog_comments SET CommentStatus = 'Approved' WHERE CommentID = ?");
=======
    $approve = $conn->prepare("UPDATE blog_comments SET status = 'Approved' WHERE id = ?");
>>>>>>> fa9af4524fe6b8e7a9aebc70fdb2fea7e44ebd99
    
    // Bind the parameter (i = integer)
    $approve->bind_param("i", $CommentID);
    
    // Execute the query
    if ($approve->execute()) {
        $_SESSION['status_message'] = "Approved successfully!";
    } else {
        $_SESSION['status_message'] = "Error: " . $conn->error;
    }
    
    // Close the statement
    $approve->close();


// Redirect back to the comments page
header("Location: comments");
exit();
?>