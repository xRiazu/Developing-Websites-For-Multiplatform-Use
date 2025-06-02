<?php
include 'database/config.php';
session_start();

// Ensure that the cid is sanitized or validated as an integer
$bid = isset($_GET['bid']) ? (int) $_GET['bid'] : 0;

    // Prepare the statement with a placeholder
    $approve = $conn->prepare("UPDATE blog SET status = 'published' WHERE id = ?");
    
    // Bind the parameter (i = integer)
    $approve->bind_param("i", $bid);
    
    // Execute the query
    if ($approve->execute()) {
        $_SESSION['status_message'] = "Approved successfully!";
    } else {
        $_SESSION['status_message'] = "Error: " . $conn->error;
    }
    
    // Close the statement
    $approve->close();


// Redirect back to the comments page
header("Location: blogs");
exit();
?>