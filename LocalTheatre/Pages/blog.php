<?php
include 'Database/config.php';
include 'Components/header.php';

$blogs = $conn->prepare("SELECT
BLogID,
BlogTitle,
BlogContent,
BlogStatus,
BlogCreated,
image_url

FROM blogs where BlogStatus = 'Approved'
");
$blogs->execute();
$blogs->store_result();
$blogs->bind_result($BlogID, $BlogTitle, $BlogContent, $BlogStatus, $BlogCreated, $BlogImg);
?>

<div class="p-4 font-[sans-serif]">
      <div class="max-w-6xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">
        <div class="max-w-md mx-auto">
          <h2 class="text-3xl font-extrabold text-gray-800 mb-12 text-center leading-10">Stay updated with the latest blog posts.</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-8">
        <?php while($blogs->fetch()) : ?>
          <?php
          $date = new DateTime($BlogCreated);
          $formattedDate = $date->format("F j, Y, g:i A");
          ?>
          <div class="bg-white rounded overflow-hidden">
            <img src="<?=ROOT_DIR?>Assets/shows/<?= $BlogImg ?>" alt="Blog Post 1" class="w-full h-52 object-cover" />
            <div class="p-6">
              <h3 class="text-lg font-bold text-gray-800 mb-3"><?= $BlogTitle ?></h3>
              <p class="text-gray-500 text-sm ellipsis"><?= $BlogContent ?></p>
              <p class="text-gray-800 text-[13px] font-semibold mt-4"><?= $formattedDate?></p>
              <a href="blogInfo?bid=<?=$BlogID?>" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-purple-600 hover:bg-purple-700 text-white text-[13px]">Read More</a>
            </div>
          </div>
          <?php endwhile ?>
        </div>
     
      </div>
    </div>

<?php
include 'Components/footer.php';
?>