<?php
/**
 * 归档页
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<!-- 网页主体开始 -->
<div class="container mx-auto px-4 py-8 pb-0 flex flex-wrap">
    <!-- 左侧菜单栏 -->
    <?php $this->need('menu.php'); ?> 
    <!-- 中间栏 -->
    <div class="main-content page-tags w-full lg:flex-1 lg:mx-6" data-aos="fade-up">
        <div data-aos="fade-up" class="rounded-lg shadow-sm p-4 lg:p-6 mb-6 bg-white dark:bg-black">
            <div class="p-2"><?php echo getArchivesList();?></div>
        </div>
    </div>
    <!-- 右侧工具栏 -->
    <?php $this->need('sider.php'); ?> 
</div>
<!-- 网页主体结束 -->
<?php $this->need('footer.php'); ?>