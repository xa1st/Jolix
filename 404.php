<?php
/**
 * 404 页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
    <style>body{min-height:100vh;display: flex;align-items:center;justify-content:center;overflow:hidden}</style>
    <!-- 通用容器 -->
    <div class="text-center rounded-md p-12 sm:p-16 shadow-2xl max-w-lg w-[90%] dark:text-gray-200/70 dark:bg-black">
        <!-- 404错误码 -->
        <div class="text-8xl sm:text-9xl font-black mb-5 dark:text-gray-200/90">404</div>
        <!-- 标题 -->
        <h1 class="text-3xl sm:text-4xl mb-4 font-bold dark:text-gray-200/70">页面走丢了喵~</h1>
        <!-- 副标题 -->
        <p class="text-lg text-gray-600 dark:text-gray-200/50 mb-8 mt-6 leading-8">这只页面可能跟<?php echo $this->author->screenName; ?>一样爱捉迷藏</p>
        <!-- 按钮组 -->
        <div class="px-8 mb-6 box-border">
            <a href="/" class="bg-orange-500 text-white hover:shadow-md py-2 w-full block rounded-md text-base font-semibold text-center">回到主页</a>
        </div>
        <!-- 底部版权 -->
        <p class="mb-2">
            &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>" class="text-orange-500 hover:text-orange-600"><?php $this->options->title(); ?></a>
        </p>
    </div>
    <!-- 统计代码 -->
    <?php echo $this->options->statistics; ?>
</body>
</html>