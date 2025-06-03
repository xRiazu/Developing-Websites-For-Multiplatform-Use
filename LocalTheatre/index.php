<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Get the requested URL from the 'url' query parameter
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
// Define available routes (URL => corresponding PHP file)
$routes = [
    '' => 'pages/home.php',          // Home route
    'home' => 'pages/home.php',          // Home route
    'contact' => 'pages/contact.php',          // contact route
    'register' => 'pages/register.php',    // register page route
    'login' => 'pages/login.php', // login page route
    'blog' => 'pages/blog.php', // blog page route
    'blogInfo' => 'pages/bloginfo.php', // blog page route
    'user/dashboard' => 'pages/user/dashboard.php', // user page route

    // admin dashboard
    'admin/admindashboard' => 'pages/admin/admindashboard.php', // admin page route
    'admin/comments' => 'pages/admin/comments.php', // comments page route
    'admin/blogs' => 'pages/admin/blogs.php', // blog table route
    'admin/edit_user' => 'pages/admin/edit_user.php', // edit user page route
    'admin/add_blog' => 'pages/admin/add_blog.php', // add blog page route

    // configuration files
    'registerController' => 'controller/registerController.php',
    'loginController' => 'controller/loginController.php',
    'logout' => 'controller/logoutController.php',
    'commentController' => 'controller/commentController.php',
    'commentControllerSanitise' => 'controller/commentControllerSanitise.php',
    'admin/approve' => 'controller/approveController.php', // admin page route
    'admin/reject' => 'controller/rejectController.php', // admin page route
    'admin/edit' => 'controller/userEditController.php', // admin page route
    'admin/delete-user' => 'controller/userDeleteController.php', // admin page route
    'admin/upload-blog' => 'controller/addBlogController.php', // admin page route
    'admin/publish-blog' => 'controller/publishBlogController.php', // admin page route
    'admin/unpublish-blog' => 'controller/unpublishBlogController.php', // admin page route
];

// Check if the URL matches a route
if (array_key_exists($url, $routes)) {
    require $routes[$url];  // Load the appropriate file for the route
} else {
    // If no route matches, show a 404 page
    require 'pages/error_404.php';
}
// 
?>