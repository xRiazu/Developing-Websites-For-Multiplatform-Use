<?php
include 'Database/config.php';
include 'Components/header.php';

// Check if the email cookie exists
$rememberedEmail = isset($_COOKIE['remembered_email']) ? $_COOKIE['remembered_email'] : '';
?>

<div class="bg-gradient-to-br from-purple-600 to-blue-400 min-h-screen flex flex-col justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md">
        <h1 class="text-4xl font-bold text-center text-black-700 mb-8">Welcome To The Local Theatre!</h1>
        <form class="space-y-6" action="login.php" method="POST">
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="email">
                    Email
                </label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-400"
                    id="email" name="email" type="email" value="<?php echo htmlspecialchars($rememberedEmail); ?>">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="password">
                    Password
                </label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-400"
                    id="password" name="password" type="password">
            </div>
            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" class="mr-2">
                <label for="remember" class="text-gray-700">Remember Me</label>
            </div>
            <div>
                <button class="w-full bg-yellow-700 hover:bg-yellow-800 text-white font-bold py-2 px-4 rounded-lg">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'Components/footer.php'; ?>
