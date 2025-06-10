<?php 
include 'Components/header.php';
include 'Database/config.php';

$uid = isset($_GET['uid']) ? (int) $_GET['uid'] : 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and collect POST values
    $username = $_POST['username'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $email = $_POST['email'] ?? '';

    // Update the user
    $update = $conn->prepare("UPDATE Users SET Username = ?, firstname = ?, surname = ?, UserEmail = ? WHERE UserID = ?");
    $update->bind_param("ssssi", $username, $firstname, $surname, $email, $uid);
    $update->execute();
    $update->close();

    // Optionally show a success message or redirect
    echo "<p class='text-green-600 text-center'>User updated successfully.</p>";
}

// Fetch user data
$user = $conn->prepare("SELECT Username, firstname, surname, UserEmail FROM Users WHERE UserID = ?");
$user->bind_param("i", $uid);
$user->execute();
$user->store_result();
$user->bind_result($Username, $firstname, $surname, $email);
$user->fetch();
?>

<h1 class="text-xl font-bold text-center mb-6">Edit User</h1>
<form class="space-y-4 font-[sans-serif] max-w-md mx-auto" action="edit.php?uid=<?= $uid ?>" method="post">
  <p>ID: <?= $uid ?></p>

  <input type="text" name="username" value="<?= htmlspecialchars($Username) ?>"
    class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" placeholder="Username" />

  <input type="text" name="firstname" value="<?= htmlspecialchars($firstname) ?>"
    class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" placeholder="First name" />

  <input type="text" name="surname" value="<?= htmlspecialchars($surname) ?>"
    class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" placeholder="Surname" />

  <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"
    class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" placeholder="Email" />

  <button type="submit"
    class="!mt-8 w-full px-4 py-2.5 mx-auto block text-sm bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
</form>

<?php include 'Components/footer.php'; ?>
