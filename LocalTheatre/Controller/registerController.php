<?php
include 'database/config.php';
session_start();

// Input sanitization
$firstname = trim($_POST['firstname']);
$surname = trim($_POST['surname']);
$Username = trim($_POST['username']);
$UserEmail = trim($_POST['email']);
$UserPassword = trim($_POST['password']);
$UserRole = trim($_POST['role']);

// Validate firstname and surname
if (!preg_match('/^[a-zA-Z0-9]+$/', $firstname)) {
    $_SESSION['status_message'] = 'Firstname is not valid! Only alphanumeric characters are allowed.';
    header('Location: register');
    exit();
}

if (!preg_match('/^[a-zA-Z0-9]+$/', $surname)) {
    $_SESSION['status_message'] = 'Surname is not valid! Only alphanumeric characters are allowed.';
    header('Location: register');
    exit();
}

// Validate password length
if (strlen($UserPassword) < 5 || strlen($UserPassword) > 20) {
    $_SESSION['status_message'] = 'Password must be between 5 and 20 characters long!';
    header('Location: register');
    exit();
}

// Validate email format
if (!filter_var($UserEmail, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['status_message'] = 'Invalid email format!';
    header('Location: register');
    exit();
}

// Check if email already exists
$stmt = $conn->prepare('SELECT id FROM users WHERE UserEmail = ?');
$stmt->bind_param('s', $UserEmail);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['status_message'] = 'Email address already exists! Please login.';
    $stmt->close();
    header('Location: login');
    exit();
}
$stmt->close();

// Hash password
$hashed_password = password_hash($UserPassword, PASSWORD_DEFAULT);

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (Username, UserEmail, UserRole, UserPassword, firstname, surname) VALUES (?, ?, ?, ?, ?, ?)");

if ($stmt) {
    $stmt->bind_param('ssssss', $Username, $UserEmail, $UserRole, $hashed_password, $firstname, $surname);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['status_message'] = 'Account successfully created! You can now log in.';
        header('Location: login');
    } else {
        $_SESSION['status_message'] = 'Account creation failed. Please try again later.';
        header('Location: register');
    }

    $stmt->close();
} else {
    $_SESSION['status_message'] = 'Database error. Please try again later.';
    header('Location: register');
}

$conn->close();
exit();
?>
