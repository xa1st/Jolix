<?php
/**
 * 留言本
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
    <div class="main-content page-links w-full lg:flex-1 lg:mx-6" data-aos="fade-up">
        <div data-aos="fade-up" class="links-box">
            <h2 class="tit"># 留言板</h2>
            <div class="post-content"><?php $this->content(); ?></div>
        </div>
        <!-- 评论框 -->
        <?php $this->need('comments.php'); ?>
    </div>
    <!-- 右侧工具栏 -->
    <?php $this->need('sider.php'); ?> 
</div>
<?php $this->need('footer.php'); ?>
