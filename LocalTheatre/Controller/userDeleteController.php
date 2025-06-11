<?php
include 'Database/config.php';
session_start();

$UserID = isset($_GET['UserID']) ? (int) $_GET['UserID'] : 0;

if ($UserID <= 0) {
    $_SESSION['status_message'] = "Invalid User ID.";
    header("Location: dashboard");
    exit();
}

// Delete user's comments first
$delete_comments = $conn->prepare("DELETE FROM blog_comments WHERE UserID = ?");
$delete_comments->bind_param("i", $UserID);

if (!$delete_comments->execute()) {
    $_SESSION['status_message'] = "Error deleting user's comments: " . $conn->error;
    $delete_comments->close();
    header("Location: dashboard");
    exit();
}
$delete_comments->close();

// Delete the user
$delete_user = $conn->prepare("DELETE FROM users WHERE UserID = ?");
$delete_user->bind_param("i", $UserID);

if ($delete_user->execute()) {
    $_SESSION['status_message'] = "User deleted successfully!";
} else {
    $_SESSION['status_message'] = "Error deleting user: " . $conn->error;
}
$delete_user->close();

header("Location: admindashboard");
exit();
?>
