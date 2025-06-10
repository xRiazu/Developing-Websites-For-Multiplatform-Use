<?php
include 'Database/config.php';
include 'Components/header.php';
$BlogID = $_GET['bid'];
$UserID = isset($_SESSION['id']) ? $_SESSION['id'] : null;

$blogs = $conn->prepare("SELECT
b.BlogTitle,
b.BlogContent,
b.BlogStatus,
b.BlogCreated,
b.image_url,
u.firstname,
u.surname

FROM blogs b
INNER JOIN users u ON b.BlogAuthorFK = u.UserID
WHERE b.BlogID = $BlogID
");
$blogs->execute();
$blogs->store_result();
$blogs->bind_result( $BlogTitle, $BlogContent, $BlogStatus, $BlogCreated, $BlogImg, $firstname, $surname);
$blogs->fetch();

// blog comments //
$blog_comments = $conn->prepare("SELECT
bc.CommentTitle,
bc.CommentCreated,
bc.CommentStatus,
bc.CommentBlogIDFK,
u.firstname,
u.surname,
u.Username

FROM blog_comments bc
INNER JOIN users u ON bc.UserIDFK = u.UserID
WHERE bc.CommentID = ? AND bc.CommentStatus = 'Approved'
");
$blog_comments->bind_param("i", $BlogID);
$blog_comments->execute();
$blog_comments->store_result();
$blog_comments->bind_result($CommentTitle, $CommentCreated, $CommentStatus, $BlogComment, $firstname, $surname, $username);


$date = new DateTime($BlogCreated);
$formattedDate = $date->format("F j, Y, g:i A");
?>

<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white"><?= $BlogTitle ?></h1>
         <div class="mt-8 lg:-mx-6 lg:flex lg:items-center">
            <img class="object-cover w-full lg:mx-6 lg:w-1/2 rounded-xl h-72 lg:h-96" src="<?= ROOT_DIR ?>Assets/shows/<?= $BlogImg ?>"alt="">
             <div class="flex flex-col">
             <?php if (isset($_SESSION['status_message'])) : ?>
            <div class="status-message"><?= $_SESSION['status_message'] ?></div>
          <?php unset($_SESSION['status_message']) ?>
          <?php endif ?>
              <div class="mt-6 lg:w-1/2 lg:mt-0 lg:mx-6 ">
                  <p href="#" class="block mt-4 text-2xl font-semibold text-gray-800 hover:underline dark:text-white md:text-3xl">
                  <?= $BlogTitle ?>                
                  </p>

                  <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                      <?= $BlogContent ?>
                  </p> 
                  <div class="flex items-center mt-6">
                      <img class="object-cover object-center w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1531590878845-12627191e687?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80" alt="">

                      <div class="mx-4">
                          <h1 class="text-sm text-gray-700 dark:text-gray-200"><?= $firstname . ' ' . $surname ?></h1>
                          <p class="text-sm text-gray-500 dark:text-gray-400"><?= $formattedDate ?></p>
                      </div>
                  </div>
              </div>
              <?php if(isset($_SESSION['UserID'])) : ?>
              <div class="mt-20">
          <form id="commentForm" action="commentControllerSanitise.php?BlogID=<?= $BlogID ?>&UserID=<?= $UserID ?>" method="post">
            <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
              Leave a Comment! <?= $BlogTitle ?>
            </label>
            <textarea id="comment" name="CommentTitle" rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Your comment..."></textarea>
            <button type="submit" class="mt-2 text-white bg-violet-600 px-4 py-2 rounded hover:bg-violet-700">
              Submit Comment
            </button>
            <p class="mt-2 text-sm text-gray-500">Your comment will appear once approved by admin.</p>
          </form>
        <?php else : ?>
           <p>Please sign in to comment on this blog, i do not know why this is working please help</p>
            </div>
        <?php endif ?>
            </div>
          </div>
        </div>

    <div class="flex justify-center relative top-1/3">
  <?php if ($blog_comments->num_rows == 0) : ?>
    <p class="mt-20">No comments have been left yet.</p>
  <?php else : ?>
    <?php while($blog_comments->fetch()) : ?>
      <div class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg">
          <div class="relative flex gap-4">
              <img src="https://icons.iconarchive.com/icons/diversity-avatars/avatars/256/charlie-chaplin-icon.png" class="relative rounded-lg -top-8 -mb-4 bg-white border h-20 w-20" alt="" loading="lazy">
              <div class="flex flex-col w-full">
                  <div class="flex flex-row justify-between">
                      <p class="relative text-xl whitespace-nowrap truncate overflow-hidden"><?= htmlspecialchars($firstname) . ' ' . htmlspecialchars($surname) ?></p>
                  </div>
                  <p class="text-gray-400 text-sm"><?= htmlspecialchars($CommentCreated) ?></p>
              </div>
          </div>
          <p class="-mt-4 text-gray-500"><?= htmlspecialchars($CommentTitle) ?></p>
      </div>
    <?php endwhile ?>
  <?php endif ?>
</div>

</div>
</section>
<script>
if (document.getElementById('commentForm')) {
  document.getElementById('commentForm').addEventListener('submit', function(event) {
    const comment = document.getElementById('comment').value.trim();
    if (comment.length < 5) {
      alert('Comment must be at least 5 characters long.');
      event.preventDefault();
    }
    if (comment.length > 500) {
      alert('Comment cannot be longer than 500 characters.');
      event.preventDefault();
    }
  });
}
</script>

<?php
include 'Components/footer.php';
?>