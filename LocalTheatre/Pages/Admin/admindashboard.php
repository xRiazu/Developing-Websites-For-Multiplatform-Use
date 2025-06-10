<?php
include 'Database/config.php';
include 'Components/header.php';

$users = $conn->prepare("SELECT
    u.UserID,
    u.Username,
    u.firstname,
    u.surname,
    u.UserEmail,
    COUNT(bc.CommentID) AS total_comments
FROM Users u
LEFT JOIN blog_comments bc ON bc.UserIDFK = u.UserID
GROUP BY u.UserID, u.Username, u.firstname, u.surname, u.UserEmail
");
$users->execute();               // Execute the query
$users->store_result();          // Store the result
$users->bind_result($UserID, $Username, $firstname, $surname, $UserEmail, $total_comments);
?>

<div class="bg-yellow-600 py-6 px-8 shadow-md rounded mb-6">
  <div class="flex justify-between max-w-3xl mx-auto">
    <a href="blogs"
      class="flex-1 mx-2 text-center px-6 py-4 bg-purple-600 text-white text-lg font-semibold rounded-lg hover:bg-blue-700 transition-all duration-200">
      Blogs
    </a>
    <a href="add_blog"
      class="flex-1 mx-2 text-center px-6 py-4 bg-purple-600 text-white text-lg font-semibold rounded-lg hover:bg-green-700 transition-all duration-200">
      + Add Blog
    </a>
    <a href="comments"
      class="flex-1 mx-2 text-center px-6 py-4 bg-purple-600 text-white text-lg font-semibold rounded-lg hover:bg-purple-700 transition-all duration-200">
      Comments
    </a>
  </div>
</div>


<h1>All Users</h1>
<?php if (isset($_SESSION['status_message'])) : ?>
  <div class="status-message"><?= $_SESSION['status_message'] ?></div>
  <?php unset($_SESSION['status_message']) ?>
<?php endif ?>
<div class="overflow-x-auto">
  <table class="min-w-full bg-white">
    <thead class="bg-gray-100 whitespace-nowrap">
      <tr>
        <th class="p-4 text-left text-[13px] font-semibold text-slate-900">
          Name
        </th>
        <th class="p-4 text-left text-[13px] font-semibold text-slate-900">
          Username
        </th>
        <th class="p-4 text-left text-[13px] font-semibold text-slate-900">
          Email
        </th>
        <th class="p-4 text-left text-[13px] font-semibold text-slate-900">
          Total Comments
        </th>
        <td class="p-4">
  <div class="flex items-center">
    <button class="mr-3" onclick="window.location.href='Admin/edit_user.php?uid=<?= urlencode($UserID) ?>'" title="Edit">
      <!-- SVG code for Edit icon here -->
    </button>
    <button class="mr-3 modal-show" data-user-id="<?= $UserID ?>" title="Delete">
      <!-- SVG code for Delete icon here -->
    </button>
  </div>
</td>

      </tr>
    </thead>

    <tbody class="whitespace-nowrap">
      <?php while ($users->fetch()) : ?>
        <tr class="hover:bg-gray-50">
          <td class="p-4 text-[15px] text-slate-900 font-medium">
            <?= $firstname . ' ' . $surname ?>
          </td>
          <td class="p-4 text-[15px] text-slate-900 font-medium">
            <?= $Username ?>
          </td>
          <td class="p-4 text-[15px] text-slate-600 font-medium">
            <?= $UserEmail ?>
          </td>
          <td class="p-4 text-[15px] text-slate-600 font-medium">
            <?= $total_comments ?>
          </td>
          <td class="p-4">
            <div class="flex items-center">
              <button class="mr-3" onclick="window.location.href='edit_user?uid=<?= urlencode($UserID) ?>'"
                title="Edit">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-blue-500 hover:fill-blue-700"
                  viewBox="0 0 348.882 348.882">
                  <path
                    d="m333.988 11.758-.42-.383A43.363 43.363 0 0 0 304.258 0a43.579 43.579 0 0 0-32.104 14.153L116.803 184.231a14.993 14.993 0 0 0-3.154 5.37l-18.267 54.762c-2.112 6.331-1.052 13.333 2.835 18.729 3.918 5.438 10.23 8.685 16.886 8.685h.001c2.879 0 5.693-.592 8.362-1.76l52.89-23.138a14.985 14.985 0 0 0 5.063-3.626L336.771 73.176c16.166-17.697 14.919-45.247-2.783-61.418zM130.381 234.247l10.719-32.134.904-.99 20.316 18.556-.904.99-31.035 13.578zm184.24-181.304L182.553 197.53l-20.316-18.556L294.305 34.386c2.583-2.828 6.118-4.386 9.954-4.386 3.365 0 6.588 1.252 9.082 3.53l.419.383c5.484 5.009 5.87 13.546.861 19.03z"
                    data-original="#000000" />
                  <path
                    d="M303.85 138.388c-8.284 0-15 6.716-15 15v127.347c0 21.034-17.113 38.147-38.147 38.147H68.904c-21.035 0-38.147-17.113-38.147-38.147V100.413c0-21.034 17.113-38.147 38.147-38.147h131.587c8.284 0 15-6.716 15-15s-6.716-15-15-15H68.904C31.327 32.266.757 62.837.757 100.413v180.321c0 37.576 30.571 68.147 68.147 68.147h181.798c37.576 0 68.147-30.571 68.147-68.147V153.388c.001-8.284-6.715-15-14.999-15z"
                    data-original="#000000" />
                </svg>
              </button>
              <button class="mr-3 modal-show"
                data-user-id="<?= $uid ?>"
                title="Delete">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                  <path
                    d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                    data-original="#000000" />
                  <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                    data-original="#000000" />
                </svg>
              </button>
            </div>
          </td>

        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
  <!-- ***********  popup   **************-->
  <div id="modal" class="hidden fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
    <div class=" w-full max-w-lg bg-white shadow-lg rounded-lg p-6 relative">
      <div class="flex items-center pb-3 border-b border-gray-300">
        <h3 class="text-gray-800 text-xl font-bold flex-1">Delete?</h3>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500"
          viewBox="0 0 320.591 320.591">
          <path
            d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
            data-original="#000000"></path>
          <path
            d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
            data-original="#000000"></path>
        </svg>
      </div>

      <div class="my-6">
      <p>Are you sure you want to delete the user with ID <span id="modal_user_id"></span>? This will also remove all comments made by the user.</p>
      </div>

      <div class="border-t border-gray-300 pt-6 flex justify-end gap-4">
        <button type="button" id="close"
          class="px-4 py-2 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300 active:bg-gray-200">Close</button>
        <button type="button" onclick="window.location.href='delete-user?uid=<?= urlencode($uid) ?>'"
          class="px-4 py-2 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700 active:bg-blue-600">Delete</button>
      </div>
    </div>
  </div>
</div>
<script>
  document.querySelectorAll('.modal-show').forEach(button => {
  button.addEventListener("click", function() {
    const UserID = this.getAttribute('data-user-id');
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modal_user_id').textContent = UserID;

    // Set the delete button link dynamically
    const deleteBtn = document.querySelector('#modal button[onclick^="window.location.href"]');
    deleteBtn.setAttribute('onclick', `window.location.href='Controller/userDeleteController.php?uid=${UserID}'`);
  });
});

</script>
<?php include 'Components/footer.php' ?>