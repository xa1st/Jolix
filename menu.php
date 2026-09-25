<?php
// 左侧菜单
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<!-- 左边栏 -->
<div class="left-sidebar w-full lg:w-60">
    <!-- 站点信息 -->
    <div class="siteinfo sider-container">
        <div class="flex flex-col items-center mb-3">
            <div class="w-30 h-30 mb-3 lg:w-30 lg:h-30">
                <img src="<?php echo $this->options->siteLogoUrl; ?>" class="w-full h-full rounded-full shadow-md inline-flex" />
            </div>
            <h2 class="text-lg font-medium lg:mb-0 dark:text-gray-100"><?php echo $this->options->siteTitle; ?></h2>
            <p class="mt-1 mb-3"><?php echo $this->options->siteDescription; ?></p>
        </div>
        <div class="hidden lg:grid grid-cols-3 gap-2 text-center py-3 border-y mb-4 border-gray-200 dark:border-gray-600/70">
            <?php $stat = \Typecho\Widget::widget('Widget_Stat'); ?>
            <div class="flex flex-col">
                <span class="text-sm">文章</span>
                <span class="font-medium mt-1"><?php echo $stat->publishedPostsNum;?></span>
            </div>
            <div class="flex flex-col">
                <span class="text-sm">分类</span>
                <span class="font-medium mt-1"><?php echo getCategoryCount(); ?></span>
            </div>
            <div class="flex flex-col">
                <span class="text-sm">评论</span>
                <span class="font-medium mt-1"><?php echo $stat->publishedCommentsNum;?></span>
            </div>
        </div>
        <?php $socialLinks = getSocialLinks(); ?>
        <div class="social">
            <?php foreach ($socialLinks as $link): ?>
                <a href="<?php echo $link['url']; ?>" title="<?php echo $link['name']; ?>" target="_blank" rel="noopener noreferrer">
                  <i class="<?php echo $link['icon']; ?>"></i>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="text-sm text-center mt-4 hidden lg:block">已在风雨中度过<i id="build-years" data-time="<?php echo $this->options->siteTime ?? date('Y-m-d'); ?>"></i></div>
    </div>
    <!-- 菜单 -->
    <div class="menu sider-container">
        <div class="flex flex-wrap justify-center lg:block">
            <a href="<?php echo $this->options->siteUrl(); ?>"  title="首页" class="item">首页</a>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while ($pages->next()): ?>
                <a href="<?php echo $pages->permalink(); ?>" title="<?php echo $pages->title(); ?>" class="item"><?php echo $pages->title(); ?></a>
            <?php endwhile; ?>             
        </div>
    </div>
    <!-- 明暗切换 -->
    <div class="hidden lg:inline text-center">
        <a class="themeToggle py-2 px-4 block">
            <i class="icon icon-moon" title="暗色"></i>
            <i class="icon icon-sun" title="亮色"></i>
            <i class="icon icon-auto" title="系统"></i>
        </a>
    </div>
</div>