<?php
// Start session and include database config
require 'Database/config.php';
session_start();

// Check required fields
if (empty($_POST['UserEmail']) || empty($_POST['UserPassword'])) {
    $_SESSION['status_message'] = 'Please fill both the email and password fields!';
    header('Location: login');
    exit();
}

// Prepare statement
if ($stmt = $conn->prepare('SELECT UserID, UserPassword, UserRole FROM users WHERE UserEmail = ?')) {
    $stmt->bind_param('s', $_POST['UserEmail']);
    $stmt->execute();
    $stmt->store_result();

    // Check if email exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($UserID, $UserPassword, $UserRole);
        $stmt->fetch();

        // Check password
        if (password_verify($_POST['UserPassword'], $UserPassword)) {
            // Auth success
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['UserEmail'] = $_POST['UserEmail'];
            $_SESSION['UserID'] = $UserID;
            $_SESSION['UserRole'] = $UserRole;

            // Set secure cookie
            setcookie("UserEmail", $_POST['UserEmail'], time() + 86400, "/", "", true, true);

            // Redirect by role
            if ($UserRole === 'Admin') {
                header('Location: Admin/admindashboard');
            } else {
                header('Location: User/dashboard');
            }
            exit();
        } else {
            // Wrong password
            $_SESSION['status_message'] = 'Incorrect email or password!';
            header('Location: login');
            exit();
        }
    } else {
        // Email not found
        $_SESSION['status_message'] = 'Incorrect email or password!';
        header('Location: login');
        exit();
    }

    $stmt->close();
} else {
    $_SESSION['status_message'] = 'Login system error. Please try again later.';
    header('Location: login');
    exit();
}
?>
