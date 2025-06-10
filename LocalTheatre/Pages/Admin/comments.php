<?php 
// Include database configuration and header
include 'Database/config.php';
include 'Components/header.php';

// Prepare the SQL query to fetch comments along with blog and user data
$blog_comments = $conn->prepare("SELECT
bc.CommentID,
bc.CommentTitle,
bc.CommentCreated,
bc.CommentStatus,
u.Username,
b.BlogTitle,
b.image_url
FROM blog_comments bc
INNER JOIN users u ON bc.UserIDFK = u.UserID
INNER JOIN blogs b ON bc.CommentBlogIDFK = b.BlogID
ORDER BY 
    CASE 
        WHEN bc.CommentStatus = 'pending' THEN 1 
        WHEN bc.CommentStatus = 'approved' THEN 2 
        WHEN bc.CommentStatus = 'rejected' THEN 3 
    END ");
$blog_comments->execute(); // Execute the query
$blog_comments->store_result(); // Store the result for later use
$blog_comments->bind_result($CommentID, $CommentTitle, $CommentCreated, $CommentStatus, $firstname, $BlogTitle, $BlogImg); // Bind the results to variables
?>
<section class="bg-white">
    <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <!-- Section heading -->
        <h2 class="text-center text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
            All comments from users
        </h2>

        <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-3 md:gap-8">
            <!-- Loop through each comment -->
            <?php while ($blog_comments->fetch()) : ?>
                <blockquote class="rounded-lg bg-gray-50 p-6 shadow-xs sm:p-8">
                    <div class="flex items-center gap-4">
                        <!-- Display blog image -->
                        <img
                            alt=""
                            src="<?= ROOT_DIR ?>Assets/shows/<?= htmlspecialchars($BlogImg) ?>"
                            class="size-14 rounded-full object-cover" />

                        <div>
                            <!-- Display blog title -->
                            <p class="mt-0.5 text-lg font-medium text-gray-900"><?= htmlspecialchars($BlogTitle) ?></p> <!-- Escape blog name -->
                        </div>
                    </div>

                    <!-- Display the comment content -->
                    <p class="mt-4 text-gray-700">
                        <?= htmlspecialchars($CommentCreated) ?> <!-- Escape comment content -->
                    </p>
                    <div>
                        <!-- Display the first name of the commenter -->
                        <p class="mt-4 text-gray-700">Comment by <?= htmlspecialchars($firstname) ?></p> <!-- Escape first name -->
                    </div>

                    <!-- Display the status of the comment (pending, approved, rejected) with appropriate styling -->
                    <span class="inline-flex items-center justify-center rounded-full px-2.5 py-0.5 text-emerald-700 <?php if ($CommentStatus === 'pending') : ?>bg-yellow-100 <?php elseif ($commentStatus === 'rejected') : ?> bg-red-100 <?php elseif ($commentStatus === 'approved') : ?> bg-emerald-100 <?php endif ?>">
                        <p class="whitespace-nowrap text-sm"><?= htmlspecialchars($CommentStatus) ?></p> <!-- Escape blog status -->
                    </span>

                    <!-- Display buttons to approve or reject the comment depending on its status -->
                    <div>
                        <span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-xs">
                           <?php if($CommentStatus === 'Pending' && 'Rejected') : ?>
                            <a href='approve?CommentID=<?= $CommentID ?>'
                                class="inline-block rounded-sm bg-green-600 px-4 py-2 text-xs font-medium text-white hover:bg-green-700"
                                onclick="return confirm('Approve this Comment?')">
                            Approve
                            </a>
                           <?php else : ?>
                            <a href='reject?CommentID=<?= $CommentID ?>'
                                class="inline-block rounded-sm bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700"
                                onclick="return confirm('Reject this Comment?')">
                            Reject
                            </a>
                            <?php endif; ?>
                        </span>
                    </div>
                </blockquote>
            <?php endwhile ?>

        </div>
    </div>
</section>

<?php
// Include the footer
include 'Components/footer.php';
?>