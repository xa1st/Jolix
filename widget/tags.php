<!-- 标签云 -->
<div class="tagsbox sider-container">
    <h2 class="text-lg font-medium mb-4 border-b border-gray-100 dark:border-gray-600/50">标签云</h2>
    <div class="tags">
        <?php $TagsCloud = getTagsCloud(); ?>
        <?php foreach ($TagsCloud as $tag): ?>
            <a href="<?php echo $tag['permalink']; ?>" title="标签「<?php echo $tag['name']; ?>」共有<?php echo $tag['count']; ?>篇文章" class="tag">
                <?php echo $tag['name']; ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>