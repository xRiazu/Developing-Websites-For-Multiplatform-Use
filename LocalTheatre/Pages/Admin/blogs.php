
<?php
include 'database/config.php';
include 'components/header.php';

$comments = $conn->prepare("SELECT
BlogID,
BlogTitle,
BlogStatus,
BlogCreated
FROM blog
ORDER BY BlogCreated
");
$comments->execute(); // Execute the query
$comments->store_result(); // Store the result for later use
$comments->bind_result($BlogID,$BlogTitle, $BlogStatus, $BlogCreated); // Bind the results to variables
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
    <?php while($comments->fetch()) : ?>
      <tr>
        <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900"> <?= htmlspecialchars($title) ?></td>
        <td class="px-4 py-2 whitespace-nowrap text-gray-700"><?= htmlspecialchars($status) ?></td>
        <td class="px-4 py-2 whitespace-nowrap text-gray-700"><?= htmlspecialchars($created) ?></td>
        <td class="px-4 py-2 whitespace-nowrap">
          <a
            href="#"
            class="inline-block rounded-sm bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
          >
            Edit
          </a>
          <a
            href="#"
            class="inline-block rounded-sm bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
          >
            Delete
          </a>
          <?php if($status === 'pending') : ?>
          <a href='publish-blog?bid=<?=$blogId ?>'
            class="bg-green-600 inline-block rounded-sm bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
          >
            Publish
          </a>

          <?php else : ?>
          <a href='unpublish-blog?bid=<?=$blogId ?>'
            class="bg-red-600 inline-block rounded-sm bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
          >
          unpublish
        </a>
        <?php endif ?>
        </td>
      </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>
<?php
include 'components/footer.php';
?>
