<?php
include 'Database/config.php';
include 'Components/header.php';
?>


<div class="m-auto bg-gray-200 flex items-center justify-center h-screen">
  <form action="<?= ROOT_DIR ?>loginController" method="POST" class="bg-white p-8 rounded-lg shadow-md w-full max-w-md space-y-6">
    <h1 class="text-2xl font-bold text-yellow-600 text-center">Login to Your Account</h1>
    <?php if (isset($_SESSION['status_message'])) : ?>
            <div class="status-message"><?= $_SESSION['status_message'] ?></div>
          <?php unset($_SESSION['status_message']) ?>
          <?php endif ?>
    <?php if (isset($_GET['error'])): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
        <?= htmlspecialchars($_GET['error']) ?>
      </div>
    <?php endif; ?>

    <div>
      <label for="Username" class="block text-sm font-medium text-gray-700">Username</label>
      <input id="Username" name="UserEmail" type="UserName" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
    </div>
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
      <input id="email" name="UserEmail" type="UserEmail" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
    </div>

    <div>
      <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
      <input id="password" name="UserPassword" type="UserPassword" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
    </div>

    <div>
      <button type="submit" class="w-full bg-yellow-600 text-white font-semibold py-2 px-4 rounded hover:bg-yellow-700">Login</button>
    </div>

    <p class="text-center text-sm text-gray-600">
      Don’t have an account? <a href="<?= ROOT_DIR ?>register" class="text-yellow-600 hover:underline">Sign up</a>
    </p>
  </form>
    </div>

<?php
include 'Components/footer.php';
?>