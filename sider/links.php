<!-- 友情链接 -->
<div class="linksbox sider-container">
    <h2 class="text-lg font-medium mb-4 border-b border-gray-200 dark:border-gray-600/50">友情链接</h2>
    <?php foreach (getLinks() as $link): ?>
        <a href="<?php echo $link['url'] ? htmlspecialchars($link['url'], ENT_QUOTES, 'UTF-8') : 'javascript:void(0)'; ?>" class="flex items-center mb-4 pb-2 border-b border-gray-100 dark:border-gray-600/40" target="_blank" rel="noopener noreferrer nofollow" title="<?php echo htmlspecialchars($link['name'] . ' - ' . $link['desc'], ENT_QUOTES, 'UTF-8'); ?>">
            <img src="<?php echo htmlspecialchars($link['avatar'], ENT_QUOTES, 'UTF-8'); ?>" class="w-8 h-8 rounded-full mr-2 shrink-0" alt="<?php echo htmlspecialchars($link['name'], ENT_QUOTES, 'UTF-8'); ?>">
            <span class="flex-1 overflow-hidden">
                <span class="block text-sm line-clamp-1"><?php echo htmlspecialchars($link['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                <span class="block text-xs text-gray-500 line-clamp-1"><?php echo htmlspecialchars($link['desc'], ENT_QUOTES, 'UTF-8'); ?></span>
            </span>
        </a>
    <?php endforeach; ?>
</div>
