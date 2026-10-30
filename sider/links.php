<!-- 友情链接（单页版本） -->
<div class="linksbox sider-container">
    <h2 class="text-lg font-medium mb-4 border-b border-gray-200 dark:border-gray-600/50">友情链接</h2>
    <?php foreach (getLinks() as $link): ?>
        <a href="<?php echo $link['url'] ? escapeHtml($link['url']) : 'javascript:void(0)'; ?>" class="flex items-center mb-4 pb-2 border-b border-gray-100 dark:border-gray-600/40" target="_blank" rel="noopener noreferrer nofollow" title="<?php echo escapeHtml($link['name'] . ' - ' . $link['desc']); ?>">
            <img src="<?php echo escapeHtml($link['avatar']); ?>" class="w-8 h-8 rounded-full mr-2 shrink-0" alt="<?php echo escapeHtml($link['name']); ?>">
            <span class="flex-1 overflow-hidden">
                <span class="block text-sm line-clamp-1"><?php echo escapeHtml($link['name']); ?></span>
                <span class="block text-xs text-gray-500 line-clamp-1"><?php echo escapeHtml($link['desc']); ?></span>
            </span>
        </a>
    <?php endforeach; ?>
</div>
