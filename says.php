<?php
/**
 * 说说
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
    <div class="main-content says-index w-full lg:flex-1 lg:mx-6"><div id="says"></div></div>
    <!-- 右侧工具栏 -->
    <?php $this->need('sider.php'); ?>
</div>
<!-- 调用Says插件初始化 -->
<?php if class_exists(\TypechoPlugin\Says\Plugin::class): ?>
    <?php \TypechoPlugin\Says\Plugin::render(10, '#says', '/memos/', ['css' => $this->options->themeUrl . '/assets/css/says.min.css?ver=202611040059', 'markdown' => libUrl('marked/15.0.7/marked.min.js?ver=202610302139', false), 'js' => $this->options->themeUrl . '/assets/js/says.min.js?ver=202611040053']);?>
<?php else: ?>
    <div class="notice">要使用说说，请安装<a href="https://github.com/xa1st/Typecho-Plugin-Says">说说插件才可开启</a></div>
<?php endif; ?>
<!-- 通用页脚 -->
<?php $this->need('footer.php'); ?>
