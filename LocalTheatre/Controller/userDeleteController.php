<?php
include 'Database/config.php';
session_start();

// Ensure that the cid is sanitized or validated as an integer
$UserID = isset($_GET['UserID']) ? (int) $_GET['UserID'] : 0;
    $delete_comment = $conn->prepare("DELETE 
    FROM blog_comments
    WHERE UserID = ?");
    
    // Bind the parameter (i = integer)
    $delete_comment->bind_param("i", $UserID);
    
    // Execute the query
    if ($delete_comment->execute()) {
        $_SESSION['status_message'] = "User updated successfully!";
    } else {
        $_SESSION['status_message'] = "Error: " . $conn->error;
    }
    
    // Close the statement
    $delete_comment->close();
    // Prepare the statement with a placeholder
    $delete_user = $conn->prepare("DELETE 
    FROM users
    WHERE UserID = ?");
    
    // Bind the parameter (i = integer)
    $delete_user->bind_param("i", $UserID);
    
    // Execute the query
    if ($delete_user->execute()) {
        $_SESSION['status_message'] = "User updated successfully!";
    } else {
        $_SESSION['status_message'] = "Error: " . $conn->error;
    }
    
    // Close the statement
    $delete_user->close();


// Redirect back to the comments page
header("Location: dashboard");
exit();
?>