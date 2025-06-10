<?php if (isset($_SESSION['status_message'])): ?>
  <div class="text-center text-green-600 font-semibold my-4">
    <?= $_SESSION['status_message']; unset($_SESSION['status_message']); ?>
  </div>
<?php endif; ?>

<?php
include 'Database/config.php';
include 'Components/header.php';

$blogs = $conn->prepare("SELECT
BlogID,
BlogTitle,
BlogStatus,
BlogCreated
FROM blogs
ORDER BY BlogCreated
");
$blogs->execute(); // Execute the query
$blogs->store_result(); // Store the result for later use
$blogs->bind_result($BlogID,$BlogTitle, $BlogStatus, $BlogCreated); // Bind the results to variables
?>

<div class="overflow-x-auto flex justify-center">
  <table class="text-center mt-10 mb-10 min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
    <thead>
      <tr>
        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900 align-left">Name</th>
        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Status</th>
        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Created</th>
        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Actions</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
    <?php while($blogs->fetch()) : ?>
      <tr>
        <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900"> <?= htmlspecialchars($BlogTitle) ?></td>
        <td class="px-4 py-2 whitespace-nowrap text-gray-700"><?= htmlspecialchars($BlogStatus) ?></td>
        <td class="px-4 py-2 whitespace-nowrap text-gray-700"><?= htmlspecialchars($BlogCreated) ?></td>
        <td class="px-4 py-2 whitespace-nowrap">
          </a>
          <?php if($BlogStatus === 'Pending') : ?>
           <a href='publish-blog?BlogID=<?= $BlogID ?>'
              class="inline-block rounded-sm bg-green-600 px-4 py-2 text-xs font-medium text-white hover:bg-green-700"
              onclick="return confirm('Publish this blog?')">
            Approve
          </a>
    <?php else : ?>
      <a href='unpublish-blog?BlogID=<?= $BlogID ?>'
          class="inline-block rounded-sm bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700"
          onclick="return confirm('Unpublish this blog?')">
            Reject
      </a>
    <?php endif; ?>
        </td>
      </tr>
    <?php endwhile ?>
    </tbody>
  </table>
</div>
<?php
include 'Components/footer.php';
?>
