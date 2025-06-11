<?php
include 'Database/config.php';
session_start();

// Validate and sanitize GET parameters
if (!isset($_GET['BlogID']) || !isset($_GET['UserID'])) {
    $_SESSION['status_message'] = "Invalid request.";
    header("Location: blogInfo");
    exit();
}

$BlogID = (int) $_GET['BlogID'];
$UserID = (int) $_SESSION['UserID'];


// Validate and sanitize POST content
if (!isset($_POST['CommentCreated'])) {
    $_SESSION['status_message'] = "Comment cannot be empty.";
    header("Location: blogInfo?bid=" . $BlogID);
    exit();
}

$CommentCreated = trim($_POST['CommentCreated']);

// Further check content length
if (strlen($CommentCreated) < 5 || strlen($CommentCreated) > 500) {
    $_SESSION['status_message'] = "Comment must be between 5 and 500 characters.";
    header("Location: blogInfo?bid=" . $BlogID);
    exit();
}

// Prepare and execute insert
$insertComment = $conn->prepare("
    INSERT INTO blog_comments 
    (CommentBlogIDFK, UserIDFK, CommentCreated) 
    VALUES (?, ?, ?)
");

if ($insertComment) {
    $insertComment->bind_param("iis", $BlogID, $UserID, $CommentCreated);

    if ($insertComment->execute()) {
        $_SESSION['status_message'] = "Comment added successfully and is awaiting approval.";
    } else {
        $_SESSION['status_message'] = "Error executing query: " . $conn->error;
    }

    $insertComment->close();
} else {
    $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
}

// Redirect back to blog
header("Location: blogInfo?bid=" . $BlogID);
exit();
?>
