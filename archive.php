<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<!-- 网页主体开始 -->
<div class="container mx-auto px-4 py-8 pb-0 flex flex-wrap">
    <!-- 左侧菜单栏 -->
    <?php $this->need('menu.php'); ?> 
    <!-- 中间栏 -->
    <div class="main-content page-archive w-full lg:flex-1 lg:mx-6" data-aos="fade-up">
        <h2 class="mb-6 pb-2 border-b border-gray-200 text-left dark:border-gray-600/70">
            <?php $this->archiveTitle([
                'category' => _t('分类 %s 下的文章'),
                'search'   => _t('包含关键字 %s 的文章'),
                'tag'      => _t('标签 %s 下的文章'),
                'author'   => _t('%s 发布的文章')
            ], '', ''); ?>
        </h2>
        <?php if ($this->have()): ?>
            <?php while ($this->next()): ?>
                <div class="blog-card bg-white rounded-lg shadow-sm p-4 lg:p-6 mb-6 dark:bg-black " data-aos="fade-up">
                    <!-- 博客标题 -->
                    <h2 class="post-title">
                        <a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                    </h2>
                    <!-- 博客摘要  -->
                    <div class="post-content"><?php $this->content('<div class="w-full text-center my-2">----------阅读全文----------</div>'); ?></div>
                    <!-- 附加内容 -->
                    <div class="flex justify-between items-center text-sm">
                        <div class="flex items-center text-sm">
                            <span><?php $this->date(); ?></span><span class="mx-3 hidden lg:inline-flex"> / </span>
                            <?php if (class_exists('\TypechoPlugin\Views\Plugin') && method_exists('\TypechoPlugin\Views\Plugin', 'getViews')): ?>
                                <span class="hidden lg:inline-flex">
                                    <?php echo \TypechoPlugin\Views\Plugin::getViews($this->cid); ?>次阅读</span><span class="mx-3 hidden lg:inline-flex"> / 
                                </span>
                            <?php endif; ?>
                            <span class="hidden lg:inline-flex"><?php $this->commentsNum('暂无评论', '1条热评', '%d条热评'); ?></span>
                        </div>
                        <div class="tags"><?php $this->tags('，', true, 'none'); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        <!-- 分页 -->
        <div data-aos="fade-up">
            <?php 
                $this->pageNav(
                    '<i class="icon icon-left"></i>', 
                    '<i class="icon icon-right"></i>', 
                    1, 
                    '...',  // 省略符
                    ['wrapTag' => 'div', 'wrapClass' => 'pagination', 'itemTag' => 'button', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev-btn',  'nextClass' => 'next-btn']
                ); 
            ?>
        </div>
    </div>
    <!-- 右侧工具栏 -->
    <?php $this->need('sider.php'); ?> 
</div>
<!-- 网页主体结束 -->
<?php $this->need('footer.php'); ?>
