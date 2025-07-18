<?php
include 'Database/config.php';
session_start();

// Ensure that the cid is sanitized or validated as an integer
$BlogID = isset($_GET['BlogID']) ? (int) $_GET['BlogID'] : 0;

    // Prepare the statement with a placeholder
    $approve = $conn->prepare("UPDATE blogs SET BlogStatus = 'Pending' WHERE BlogID = ?");
    
    // Bind the parameter (i = integer)
    $approve->bind_param("i", $BlogID);
    
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