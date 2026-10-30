<?php

/**
 * ​Jolix​​中文"极简"（Jiǎn） + 拉丁语Lux（光）象征轻量化主题如光般流畅
 * ​支持响应式，基于tailwindcss4.1的简约三栏主题
 * 
 * @package Jolix
 * @author 猫东东
 * @version 1.4.6.0
 * @link https://github.com/xa1st/Jolix
 * @license Mulan PSL v2
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<!-- 网页主体开始 -->
<div class="container mx-auto px-4 py-8 pb-0 flex flex-wrap">
    <!-- 左侧菜单栏 -->
    <?php $this->need('menu.php'); ?> 
    <!-- 中间栏 -->
    <div class="main-content page-index w-full lg:flex-1 lg:mx-6 overflow-hidden">
        <?php while ($this->next()): ?>
            <!-- 博客循环体 -->
            <div class="blog-card bg-white rounded-lg shadow-sm p-3 lg:p-6 mb-6 dark:bg-black " data-aos="fade-up">
                <!-- 博客标题 -->
                <h2 class="post-title">
                    <a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                </h2>
                <!-- 博客摘要  -->
                <div class="post-content"><?php $this->content('<div class="w-full text-center my-2 post-more">----------阅读全文----------</div>'); ?></div>
                <!-- 附加内容 -->
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center text-sm">
                        <span><?php $this->date(); ?></span><span class="mx-3 hidden lg:inline-flex"> / </span>
                        <?php if (class_exists('\TypechoPlugin\Views\Plugin') && method_exists('\TypechoPlugin\Views\Plugin', 'getViews')): ?>
                            <span class="hidden lg:inline-flex">
                                <?php echo \TypechoPlugin\Views\Plugin::getViews($this->cid); ?>次阅读</span><span class="mx-3 hidden lg:inline-flex"> / 
                            </span>
                        <?php endif; ?>
                        <a class="hidden lg:inline-flex" href="<?php $this->permalink() ?>#commentbox" title="<?php $this->commentsNum('暂无评论', '1条热评', '%d条热评'); ?>"><?php $this->commentsNum('暂无评论', '1条热评', '%d条热评'); ?></a>
                    </div>
                    <div class="tags"><?php $this->tags('，', true, 'none'); ?></div>
                </div>
            </div>
        <?php endwhile; ?>
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

