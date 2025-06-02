<?php 
    include 'components/header.php';
    include 'database/config.php';
    $uid = isset($_GET['uid']) ? (int) $_GET['uid'] : 0;

    $user = $conn->prepare("SELECT
    u.Username,
    u.firstname,
    u.surname,
    u.email
FROM users u
where UserID = $uid
");
$users->execute();               // Execute the query
$users->store_result();          // Store the result
$users->bind_result($Username, $firstname, $surname, $email);
$users->fetch();
?>
    <h1>Edit Users</h1>
    <form class="space-y-4 font-[sans-serif] max-w-md mx-auto" action="edit?uid=<?= $uid ?>" method="post">
      <p>ID: <?= $uid ?></p>
      <input type="text" name="firstname" value="<?= $Username ?>"
        class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" />

      <input type="text" name="firstname" value="<?= $firstname ?>"
        class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" />

      <input type="text" name="surname" value="<?= $surname ?>"
        class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded" />
        <input type="text" name="email" value="<?= $email ?>"
        class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded" />
     

      <button type="submit"
        class="!mt-8 w-full px-4 py-2.5 mx-auto block text-sm bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
    </form>
<?php include 'components/footer.php' ?>