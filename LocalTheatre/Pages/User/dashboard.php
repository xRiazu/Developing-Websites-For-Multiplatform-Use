<?php 
include 'Components/header.php';
include 'Database/config.php';

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['UserID'];

$Users = $conn->prepare("SELECT
    u.Username,
    bc.CommentTitle,
    bc.CommentCreated.
    bc.CommentStatus,
    b.BlogTitle
    FROM blog_comments bc
    JOIN blog b ON bc.CommentBlogIDFK = b.BlogID
    WHERE bc.UserIDKFK = ?
    ");
    $users->execute();               // Execute the query
    $users->store_result();          // Store the result
    $users->bind_result($Username, $CommentTitle, $CommentCreated, $CommentStatus, $BlogTitle);
?>

<div class="bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full max-w-4xl rounded-lg font-[sans-serif] overflow-hidden mx-auto mt-4 mb-20">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-800">User Dashboard</h3>
        <p class="mt-2 text-sm text-gray-500">Hi <span class="font-medium text-gray-700"><?= htmlspecialchars($user['Username']) ?></span>, here are your blog comments:</p>

        <?php if (count($comments) > 0): ?>
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-2 border-b">Username</th>
                            <th class="px-4 py-2 border-b">Blog Title</th>
                            <th class="px-4 py-2 border-b">Comment</th>
                            <th class="px-4 py-2 border-b">Created At</th>
                            <th class="px-4 py-2 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php foreach ($comments as $comment): ?>
                            <tr>
                                <td class="px-4 py-2"><?= htmlspecialchars($user['Username']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($comment['BlogTitle']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($comment['CommentTitle']) ?></td>
                                <td class="px-4 py-2"><?= date('M d, Y', strtotime($comment['CommentCreated'])) ?></td>
                                <td class="px-4 py-2">
                                    <span class="<?= match(strtolower($comment['CommentStatus'])) {
                                        'approved' => 'text-green-600',
                                        'pending' => 'text-yellow-600',
                                        'rejected' => 'text-red-600',
                                        default => 'text-gray-600'
                                    } ?>">
                                        <?= htmlspecialchars($comment['CommentStatus']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="mt-4 text-sm text-gray-600">You haven't made any comments yet.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'components/footer.php' ?>