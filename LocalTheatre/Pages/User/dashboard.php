<?php 
include 'Components/header.php';
include 'Database/config.php';

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['UserID'];
echo $userID;

$user_name = $_SESSION['Username'];

$users = $conn->prepare("SELECT
        u.Username,
        bc.CommentTitle,
        bc.CommentCreated,
        bc.CommentStatus,
        b.BlogTitle,
        COUNT(bc.CommentID) AS total_comments
    FROM blog_comments bc
    JOIN users u ON bc.CommentBlogIDFK = u.UserID
    JOIN blogs b ON bc.CommentBlogIDFK = b.BlogID
    WHERE bc.UserIDFK = ?
    ");
    $users->bind_param('i', $userID);
    $users->execute();               // Execute the query
    $users->store_result();          // Store the result
    $users->bind_result($Username, $CommentTitle, $CommentCreated, $CommentStatus, $BlogTitle, $total_comments);
    $users->fetch();
?>

<div class="bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full max-w-4xl rounded-lg font-[sans-serif] overflow-hidden mx-auto mt-4 mb-20">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-800">User Dashboard</h3>
        <p class="mt-2 text-sm text-gray-500">Hello <span class="font-medium text-gray-700"><?= htmlspecialchars($user_name) ?></span>, here are your blog comments:</p>

        <?php if (($total_comments) > 0): ?>
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-2 border-b">Blog Title</th>
                            <th class="px-4 py-2 border-b">Comment</th>
                            <th class="px-4 py-2 border-b">Created At</th>
                            <th class="px-4 py-2 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php foreach ($comments as $comment): ?>
                            <tr>
                                <td class="px-4 py-2"><?= htmlspecialchars($Username['Username']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($BlogTitle['BlogTitle']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($CommentTitle['CommentTitle']) ?></td>
                                <td class="px-4 py-2"><?= date('M d, Y', strtotime($CommentCreated['CommentCreated'])) ?></td>
                                <td class="px-4 py-2">
                                    <span class="<?= match(strtolower($CommentStatus['CommentStatus'])) {
                                        'approved' => 'text-green-600',
                                        'pending' => 'text-yellow-600',
                                        'rejected' => 'text-red-600',
                                        default => 'text-gray-600'
                                    } ?>">
                                        <?= htmlspecialchars($CommentStatus['CommentStatus']) ?>
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