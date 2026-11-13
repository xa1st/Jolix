<!-- 最新评论 -->
<div class="commentbox sider-container">
    <h2 class="text-lg font-medium mb-4 pb-2 border-b border-gray-200 dark:border-gray-600/50">最新评论</h2>
    <?php $comments = getComments(); ?>
    <?php foreach ($comments as $comment): ?>
    <div class="mb-4 pb-2 border-b border-gray-100 dark:border-gray-600/40">
        <a href="<?php echo $comment['permalink']; ?>" class="text-sm line-clamp-2" rel="external nofollow"><?php echo htmlspecialchars($comment['excerpt']); ?></a>
        <div class="text-sm text-gray-500 mt-1"><?php echo htmlspecialchars($comment['author']); ?> · <?php echo $comment['date']; ?></div>
    </div>
    <?php endforeach; ?>
</div>