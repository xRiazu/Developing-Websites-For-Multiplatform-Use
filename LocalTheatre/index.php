<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Get the requested URL from the 'url' query parameter
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
// Define available routes (URL => corresponding PHP file)
$routes = [
    '' => 'Pages/home.php',          // Home route
    'home' => 'Pages/home.php',          // Home route
    'contact' => 'Pages/contact.php',          // contact route
    'register' => 'Pages/register.php',    // register page route
    'login' => 'Pages/login.php', // login page route
    'blog' => 'Pages/blog.php', // blog page route
    'blogInfo' => 'Pages/bloginfo.php', // blog page route
    'User/dashboard' => 'Pages/User/dashboard.php', // user page route

    // admin dashboard
    'Admin/admindashboard' => 'Pages/Admin/admindashboard.php', // admin page route
    'Admin/comments' => 'Pages/Admin/comments.php', // comments page route
    'Admin/blogs' => 'Pages/Admin/blogs.php', // blog table route
    'Admin/edit_user' => 'Pages/Admin/edit_user.php', // edit user page route
    'Admin/add_blog' => 'Pages/Admin/add_blog.php', // add blog page route

    // configuration files
    'registerController' => 'Controller/registerController.php',
    'loginController' => 'Controller/loginController.php',
    'logout' => 'Controller/logoutController.php',
    'commentController' => 'Controller/commentController.php',
    'commentControllerSanitise' => 'Controller/commentControllerSanitise.php',
    'Admin/approve' => 'Controller/approveController.php', // admin page route
    'Admin/reject' => 'Controller/rejectController.php', // admin page route
    'Admin/edit' => 'Controller/userEditController.php', // admin page route
    'Admin/delete-user' => 'Controller/userDeleteController.php', // admin page route
    'Admin/upload-blog' => 'Controller/addBlogController.php', // admin page route
    'Admin/publish-blog' => 'Controller/publishBlogController.php', // admin page route
    'Admin/unpublish-blog' => 'Controller/unpublishBlogController.php', // admin page route
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