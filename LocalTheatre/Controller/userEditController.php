<?php
include 'database/config.php';
session_start();

// Ensure that the cid is sanitized or validated as an integer
$uid = isset($_GET['uid']) ? (int) $_GET['uid'] : 0;

    // Prepare the statement with a placeholder
    $approve = $conn->prepare("UPDATE 
    users SET 
    firstname = ? ,
    surname = ?,
    email = ?
    WHERE id = ?");
    
    // Bind the parameter (i = integer)
    $approve->bind_param("sssi", $_POST['firstname'], $_POST['surname'], $_POST['email'], $uid);
    
    // Execute the query
    if ($approve->execute()) {
        $_SESSION['status_message'] = "User updated successfully!";
    } else {
        $_SESSION['status_message'] = "Error: " . $conn->error;
    }
    
    // Close the statement
    $approve->close();


// Redirect back to the comments page
header("Location: dashboard");
exit();
?>