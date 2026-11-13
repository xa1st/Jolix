<!-- 最近文章 -->
<div class="postsbox sider-container">
    <h2 class="text-lg font-medium mb-4 border-b border-gray-200 dark:border-gray-600/50">最近文章</h2>
    <?php foreach (getRecentPosts() as $post): ?>
        <div class="mb-4 pb-2 border-b border-gray-100 dark:border-gray-600/40">
            <a href="<?php echo $post['permalink']; ?>" class="text-sm line-clamp-2" title="<?php echo htmlspecialchars($post['title']); ?>"><?php echo htmlspecialchars($post['title']); ?></a>
            <div class="text-sm text-gray-500 mt-1"><?php echo $post['date']; ?></div>
        </div>
    <?php endforeach; ?>
</div>
