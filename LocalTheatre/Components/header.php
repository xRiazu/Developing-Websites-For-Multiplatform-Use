<?php
define('ROOT_DIR', '/Developing-Websites-For-Multiplatform-Use-1/LocalTheatre/');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Local Theatre</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?= ROOT_DIR ?>assets/css/style.css">
</head>
<body class="flex flex-col min-h-screen">

<header class="bg-yellow-600 py-4 px-4 sm:px-10 shadow-lg font-[sans-serif] tracking-wide relative z-50">
  <div class="flex flex-wrap items-center justify-between w-full">
    <!-- Logo and Site Name -->
    <a href="<?= ROOT_DIR ?>" class="flex items-center gap-4">
      <img src="<?= ROOT_DIR ?>Assets/shows/clyde_theatre_tp.png" alt="The Local Theatre Logo" class="w-14 h-14 p-1" />
      <span class="text-2xl font-extrabold text-white hidden sm:inline">The Local Theatre</span>
    </a>

<ul class="hidden lg:flex gap-x-6 items-center text-white font-semibold text-[16px] ml-12">
  <li><a href="<?= ROOT_DIR ?>" class="hover:underline">Home</a></li>
  <li><a href="<?= ROOT_DIR ?>blog" class="hover:underline">Blog</a></li>
  <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
    <?php if ($_SESSION['UserRole'] === 'Admin') : ?>
      <li><a href="<?= ROOT_DIR ?>Admin/admindashboard" class="hover:underline">Dashboard</a></li>
    <?php elseif ($_SESSION['UserRole'] === 'User') : ?>
      <li><a href="<?= ROOT_DIR ?>User/dashboard" class="hover:underline">Dashboard</a></li>
    <?php endif ?>
  <?php endif; ?>

  <li><a href="<?= ROOT_DIR ?>contact" class="hover:underline">Contact</a></li>
</ul>

    <div class="flex items-center space-x-6 ml-auto">
      <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) : ?>
        <a href="<?= ROOT_DIR ?>login" class="text-white hover:underline font-semibold text-[15px]">Login</a>
        <a href="<?= ROOT_DIR ?>register" class="px-4 py-2 text-sm rounded-sm font-bold text-yellow-600 bg-white border-2 border-white hover:bg-transparent hover:text-white transition">Sign up</a>
      <?php else : ?>
        <a href="<?= ROOT_DIR ?>logout" class="px-4 py-2 text-sm rounded-sm font-bold text-yellow-600 bg-white border-2 border-white hover:bg-transparent hover:text-white transition">Logout</a>
      <?php endif; ?>

      <button id="toggleOpen" class="lg:hidden">
        <svg class="w-7 h-7" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
  </div>

  <div id="collapseMenu" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 lg:hidden">
    <div class="bg-yellow-600 w-3/4 max-w-xs h-full p-6 overflow-auto relative">
      <button id="toggleClose" class="absolute top-4 right-4 w-9 h-9 bg-white text-yellow-600 rounded-full flex items-center justify-center">
        ✕
      </button>
      <ul class="space-y-4 mt-10 text-white font-semibold text-[16px]">
        <li><a href="<?= ROOT_DIR ?>" class="block hover:underline">Home</a></li>
        <li><a href="<?= ROOT_DIR ?>blog" class="block hover:underline">Blog</a></li>
        <li><a href="<?= ROOT_DIR ?>contact" class="block hover:underline">Contact</a></li>

        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
          <?php if ($_SESSION['UserRole'] === 'Admin') : ?>
            <li><a href='<?= ROOT_DIR ?>Admin/admindashboard' class='block hover:underline'>Dashboard</a></li>
            <li><a href='<?= ROOT_DIR ?>Admin/comments' class='block hover:underline'>Comments</a></li>
            <li><a href='<?= ROOT_DIR ?>Admin/blogs' class='block hover:underline'>Edit Blogs</a></li>
            <li><a href='<?= ROOT_DIR ?>Admin/add-blog' class='block hover:underline'>Add Blogs</a></li>
          <?php elseif ($_SESSION['UserRole'] === 'User') : ?>
            <li><a href='<?= ROOT_DIR ?>User/dashboard' class='block hover:underline'>Dashboard</a></li>
          <?php endif; ?>
          <li><a href="<?= ROOT_DIR ?>logout" class="block hover:underline">Logout</a></li>
        <?php else : ?>
          <li><a href="<?= ROOT_DIR ?>login" class="block hover:underline">Login</a></li>
          <li><a href="<?= ROOT_DIR ?>register" class="block hover:underline">Sign up</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</header>

<main class="flex-grow">
