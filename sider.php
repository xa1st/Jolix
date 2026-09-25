<?php
// 右侧工具栏目
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<!-- 右边栏 -->
<div class="right-sidebar w-full hidden xl:block xl:w-64">
    <?php $sidebarData = getSidebarData(); ?>
    <!-- 搜索框 -->
    <div class="searchbox sider-container">
        <h2 class="text-lg font-medium mb-4 border-b border-gray-200 dark:border-gray-600/50">搜索</h2>
        <form method="get" action="<?php $this->options->siteUrl(); ?>" class="search-container relative" role="search">
            <input type="text" name="s" value="<?php if($this->is('search')){$this->archiveTitle('', '', '');} ?>" placeholder="搜索..." class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md text-sm focus:outline-none dark:border-gray-600/70 dark:text-gray-100">
            <button type="submit" class="absolute right-2 top-2 dark:text-gray-200"><i class="icon icon-search "></i></button>
        </form>
    </div>
    <!-- 文章分类 -->
    <div class="categorybox sider-container">
        <h2 class="text-lg font-medium mb-4 border-b border-gray-200 dark:border-gray-600/50">分类</h2>
        <ul>
            <?php $categoryIcon = getCategoryIcons(); $i = 0;?>
            <?php foreach ($sidebarData['categories'] as $category): ?>
                <li class="cate-item">
                    <a href="<?php echo $category['permalink']; ?>" class="block relative" title="<?php echo $category['name']; ?>">
                        <span class="cate cate-<?php echo $category['slug']; ?>">
                            <!-- 显示分类图标 -->
                            <?php if (!empty($categoryIcon[$i])): ?><span class="cate-icon cate-icon-<?php echo $i; ?>"><?php echo $categoryIcon[$i]; ?></span><?php endif; ?>
                            <!-- 显示分类名称-->
                            <span class="cate-name"><?php echo $category['name']; ?></span>
                            <!-- 显示分类文章数量 -->
                            <span class="text-xs leading-6 absolute right-2">(<?php echo $category['count']; ?>)</span>
                        </span>
                    </a>
                </li>
            <?php $i++; endforeach; ?>
        </ul>
    </div>
    <!-- 最新评论 -->
    <div class="commentbox sider-container">
        <h2 class="text-lg font-medium mb-4 pb-2 border-b border-gray-200 dark:border-gray-600/50">最新评论</h2>
        <?php foreach ($sidebarData['comments'] as $comment): ?>
        <div class="mb-4 pb-2 border-b border-gray-100 dark:border-gray-600/40">
            <a href="<?php echo $comment['permalink']; ?>" class="text-sm line-clamp-2" rel="external nofollow"><?php echo $comment['excerpt']; ?></a>
            <div class="text-sm text-gray-500 mt-1"><?php echo $comment['author']; ?> · <?php echo $comment['date']; ?></div>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- 标签云 -->
    <div class="tagsbox sider-container">
        <h2 class="text-lg font-medium mb-4 border-b border-gray-100 dark:border-gray-600/50">标签云</h2>
        <div class="tags">
            <?php foreach ($sidebarData['tags'] as $tag): ?>
                <a href="<?php echo $tag['permalink']; ?>" title="标签「<?php echo $tag['name']; ?>」共有<?php echo $tag['count']; ?>篇文章" class="tag">
                    <?php echo $tag['name']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

