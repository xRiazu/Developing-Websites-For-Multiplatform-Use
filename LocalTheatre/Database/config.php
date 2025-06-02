<?php
$hn = "localhost";
$un = "uzair_admin";
$pw = "BINGb7Z@]]LsKnYk";
$db = "local_theatre";
// Create database connection
$conn = new mysqli($hn, $un, $pw, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// else echo 'connection successful';
?>