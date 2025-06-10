<?php
// Start sessions and include the database configuration file
require 'Database/config.php';
session_start();

// Check if login form was submitted
if (empty($_POST['UserEmail']) || empty($_POST['UserPassword'])) {
    // Set a session error message and redirect to the login page if fields are empty
    $_SESSION['status_message'] = 'Please fill both the username and password fields!';
    header('Location: login');
    exit();
}

// Prepare SQL statement to prevent SQL injection
if ($stmt = $conn->prepare('SELECT UserID, UserPassword, UserRole FROM users WHERE UserEmail = ?')) {
    // Bind the input parameter (email) and execute the statement
    $stmt->bind_param('s', $_POST['UserEmail']);
    $stmt->execute();
    $stmt->store_result();
    
    // Check if the email exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($UserID, $UserPassword, $UserRole);
        $stmt->fetch();
        
        // Verify the password using password_verify
        if (password_verify($_POST['UserPassword'], $UserPassword)) {
            // Password is correct, start user session
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['Username'] = $_POST['UserEmail'];
            $_SESSION['UserID'] = $UserID;
            $_SESSION['UserRole'] = $UserRole;

            // Set a cookie with the username (HTTP only and secure)
            setcookie("UserEmail", $_POST['UserEmail'], time() + 86400, "/", "", true, true);

            // Redirect based on user type (admin or regular user)
            if ($UserRole == 'Admin') {
                header('Location: Admin/admindashboard');
            } else {
                header('Location: user/dashboard');
            }
            exit();
        } else {
            // Incorrect password
            $_SESSION['status_message'] = 'Incorrect email or password!';
            header('Location: login');
            exit();
        }
    } else {
        // Username does not exist
        $_SESSION['status_message'] = 'Incorrect email or password';
        header('Location: login');
        exit();
    }
    
    // Close the statement
    $stmt->close();
} else {
    // SQL statement preparation failed
    $_SESSION['status_message'] = 'Login system error. Please try again later.';
    header('Location: login');
    exit();
}
?>