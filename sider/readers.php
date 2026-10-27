<!-- 读者墙 -->
<div class="readersbox sider-container">
    <h2 class="text-lg font-medium mb-4 border-b border-gray-200 dark:border-gray-600/50">读者墙</h2>
    <?php $readers = getReaders();?>
    <div class="readers">
        <?php foreach ($readers as $reader): ?>
            <a href="<?php echo $reader['url']; ?>" class="block" rel="external nofollow" title="<?php echo htmlspecialchars($reader['author']); ?>">
                <img src="<?php echo $reader['avatar']; ?>" class="w-8 h-8 rounded-full mx-auto" alt="<?php echo htmlspecialchars($reader['author']); ?>" title="共留言<?php echo $reader['count']; ?>次,最后访问：<?php echo (date('Y年m月d日 H:i:s', $reader['last_time'])); ?>">
            </a>
        <?php endforeach; ?>
    </div>
</div>