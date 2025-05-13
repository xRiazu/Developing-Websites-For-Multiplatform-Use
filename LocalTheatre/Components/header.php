<?php
define('ROOT DIR', 'C:\xampp\htdocs\Developing-Websites-For-Multiplatform-Use\Local Theatre');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Local Theatre Company</title>
    <script src="https://tailwindflex.com/"></script>
    <link rel="stylesheet" href="<?= ROOT_DIR ?>assets/css/style.css">
</head>
<body>
    
<header class="bg-white">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="md:flex md:items-center md:gap-12">
                <a class="block text-rose-600" href="#">
                    <span class="sr-only">Home</span>
                    <span class="text-2xl font-bold">LOGO</span>
                </a>
            </div>

            <div class="hidden md:block">
                <nav aria-label="Global">
                    <ul class="flex items-center gap-6 text-sm">
                        <li>
                            <a class="text-gray-500 transition hover:text-gray-500/75" href="#">
                                Home
                            </a>
                        </li>

                        <li>
                            <a class="text-gray-500 transition hover:text-gray-500/75" href="#">
                                Blog
                            </a>
                        </li>

                        <li>
                            <a class="text-gray-500 transition hover:text-gray-500/75" href="#">
                                Contact
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <div class="sm:flex sm:gap-4">
                    <a class="rounded-md bg-rose-600 px-4 py-1.5 sm:px-5 sm:py-2.5 text-sm font-medium text-white shadow-sm"
                        href="#">
                        Login
                    </a>

                    <div class="hidden sm:flex">
                        <a class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-rose-600" href="#">
                            Register
                        </a>
                    </div>
                </div>

                <div class="block md:hidden">
                    <button
                                class="rounded-sm p-2 text-gray-600 transition hover:text-gray-600/75"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                </svg>
                            </button>
                </div>
            </div>
        </div>
    </div>
</header>
</body>
<main class="flex-grow">