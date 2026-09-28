<?php
// 右侧工具栏目
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<!-- 右边栏 -->
<div class="right-sidebar w-full hidden xl:block xl:w-64">
    <!-- 搜索框 -->
    <div class="searchbox sider-container">
        <h2 class="text-lg font-medium mb-4 border-b border-gray-200 dark:border-gray-600/50">搜索</h2>
        <form method="get" action="<?php $this->options->siteUrl(); ?>" class="search-container relative" role="search">
            <input type="text" name="s" value="<?php if($this->is('search')){$this->archiveTitle('', '', '');} ?>" placeholder="搜索..." class="w-full pl-3 pr-10 py-2 border border-gray-200 rounded-md text-sm focus:outline-none dark:border-gray-600/70 dark:text-gray-100">
            <button type="submit" class="absolute right-2 top-2 dark:text-gray-200"><i class="icon icon-search "></i></button>
        </form>
    </div>
    <!-- 文章分类 -->
    <div class="categorybox sider-container">
        <h2 class="text-lg font-medium mb-4 border-b border-gray-200 dark:border-gray-600/50">分类</h2>
        <ul>
            <?php $categoryIcon = getCategoryIcons(); $i = 0;?>
            <!-- 分类去掉缓存，没必要，一般博客分类不会频繁变动 -->
            <?php \Typecho\Widget::widget('Widget_Metas_Category_List')->to($categorys); ?>
            <?php while ($categorys->next()): ?>
                <li class="cate-item">
                    <a href="<?php echo $categorys->permalink; ?>" class="block relative" title="<?php echo $categorys->name; ?>">
                        <span class="cate cate-<?php echo $categorys->slug; ?>">
                            <!-- 显示分类图标 -->
                            <?php if (!empty($categoryIcon[$i])): ?><span class="cate-icon cate-icon-<?php echo $i; ?>"><?php echo $categoryIcon[$i]; ?></span><?php endif; ?>
                            <!-- 显示分类名称-->
                            <span class="cate-name"><?php echo $categorys->name; ?></span>
                            <!-- 显示分类文章数量 -->
                            <span class="text-xs leading-6 absolute right-2">(<?php echo $categorys->count; ?>)</span>
                        </span>
                    </a>
                </li>
            <?php $i++; endwhile; ?>
        </ul>
    </div>
    <!-- 侧边栏组件开始 -->
    <?php
        // 侧边栏组件
        $allow = ['comments', 'tags', 'readers', 'posts', 'links'];
        // 获取侧边栏组件
        $order = array_values(array_unique(array_intersect(array_filter(array_map('trim', explode('|', (string)$this->options->sidebarLayout))),$allow)));
        // 按需加载
        foreach ($order as $block) $this->need('sider/' . $block . '.php');
    ?>
    <!-- 侧边栏组件结束 -->
</div>

