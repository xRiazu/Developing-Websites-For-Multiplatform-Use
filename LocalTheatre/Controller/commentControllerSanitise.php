<?php
include 'database/config.php';
session_start();

// Validate and sanitise GET parameters
if (!isset($_GET['bid']) || !isset($_GET['uid'])) {
    $_SESSION['status_message'] = "Invalid request.";
    header("Location: blogInfo");
    exit();
}
// cast to integer cleans the input into a number and ignores anything that isn't a number.
$BlogID = (int) $_GET['bid']; // Cast to integer
$UserID = (int) $_GET['uid']; // Cast to integer

// Validate and sanitise POST content
if (!isset($_POST['content']) || empty(trim($_POST['content']))) {
    $_SESSION['status_message'] = "Comment cannot be empty.";
    header("Location: blogInfo?bid=" . $BlogID);
    exit();
}

$content = trim($_POST['content']);

// Further check content length
if (strlen($content) < 5 || strlen($content) > 500) {
    $_SESSION['status_message'] = "Comment must be between 5 and 500 characters.";
    header("Location: blogInfo?bid=" . $BlogID);
    exit();
}
// Prepare and execute statement
// Using prepared statements will help prevent sql injection
$insertComment = $conn->prepare("INSERT INTO blog_comments (content, BlogID, UserID) VALUES (?, ?, ?)");

if ($insertComment) {
    $insertComment->bind_param("sii", $content, $BlogID, $UserID);

    if ($insertComment->execute()) {
        $_SESSION['status_message'] = "Comment added successfully!";
    } else {
        $_SESSION['status_message'] = "Error executing query: " . $conn->error;
    }

    $insertComment->close();
} else {
    $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
}

// Redirect back to the blog page
header("Location: blogInfo?bid=" . $BlogID);
exit();
?>