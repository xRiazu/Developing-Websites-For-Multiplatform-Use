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
$UserID = (int) $_GET['UserID'];

// Validate and sanitize POST content
if (!isset($_POST['content']) || empty(trim($_POST['content']))) {
    $_SESSION['status_message'] = "Comment cannot be empty.";
    header("Location: blogInfo?bid=" . $BlogID);
    exit();
}

$CommentTitle = trim($_POST['content']);

// Further check content length
if (strlen($CommentTitle) < 5 || strlen($CommentTitle) > 500) {
    $_SESSION['status_message'] = "Comment must be between 5 and 500 characters.";
    header("Location: blogInfo?bid=" . $BlogID);
    exit();
}

// Prepare and execute insert
$insertComment = $conn->prepare("
    INSERT INTO blog_comments 
    (CommentTitle, CommentBlogIDFK, CommentUserIDFK, CommentStatus, CommentCreated) 
    VALUES (?, ?, ?, 'Pending', NOW())
");

if ($insertComment) {
    $insertComment->bind_param("sii", $CommentTitle, $BlogID, $UserID);

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
