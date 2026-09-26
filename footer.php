<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    <!-- 网页底部 -->
    <footer class="bg-white dark:bg-(--bg-primary) mt-4 border-t border-gray-200 dark:border-gray-600">
        <div class="mx-auto px-4 py-8 text-center leading-8">
            <p class="text-sm">
                <span class="hidden md:inline-flex">© <?php echo getCopyrightYear(); ?> <?php $this->options->title(); ?><span> | </span></span>
                POWERED BY <a href="//typecho.org" title="骄傲地使用Typecho">Typecho</a><span> | </span>
                THEME BY <a href="//github.com/xa1st/jolix" title="JoLix主题，版本<?php echo getThemeVersion(); ?>，作者：猫东东">JoLix</a>
            </p>
            <?php if ($this->options->footerInfo): ?>
                <p class="text-sm mt-2"><?php echo $this->options->footerInfo; ?></p>
            <?php endif; ?>
        </div>
    </footer>
    <!-- 浮动按钮组 -->
    <div id="tooltip" class="fixed bottom-8 right-4 z-50 flex flex-col items-center opacity-0 transition-opacity duration-300 pointer-events-none">
        <!-- 搜索按钮 (仅在小屏幕显示) -->
        <a id="search-btn" class="w-10 h-10 bg-white dark:bg-black rounded-full shadow-md flex items-center justify-center mb-2 lg:hidden" href="javascript:;">
            <i class="icon icon-search"></i>
        </a>
        <!-- 切换明暗按钮 (仅在小屏幕显示) -->
        <a id="themeToggle" class="themeToggle w-10 h-10 bg-white dark:bg-black rounded-full shadow-md flex items-center justify-center mb-2 lg:hidden" href="javascript:;">
            <i class="icon icon-moon"></i><i class="icon icon-sun"></i><i class="icon icon-auto"></i>
        </a>
        <!-- 回到顶部按钮 -->
        <a id="back-to-top" class="w-10 h-10 bg-white dark:bg-black rounded-full shadow-md flex items-center justify-center mb-2" href="javascript:;">
            <i class="icon icon-up"></i>
        </a>
    </div>
    <!-- 移动搜索弹窗 -->
    <div id="mobile-search" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-lg p-4 w-full max-w-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">搜索</h3>
                <button id="close-search" class="text-gray-500 hover:text-gray-700"><i class="icon icon-close"></i></button>
            </div>
            <form method="get" action="<?php $this->options->siteUrl(); ?>" role="search" class="relative">
                <input type="text" name="s" placeholder="搜索..." class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                <button type="submit" class="absolute right-2 top-2 text-gray-400"><i class="icon icon-search"></i></button>
            </form>
        </div>
    </div>
    <!-- 系统默认底部分 -->
    <?php $this->footer(); ?>
    <!-- 统计代码 -->
    <?php echo $this->options->statistics; ?>
    <!-- JS 文件 - 放在底部提升性能 -->
    <script src="<?php getCDN(); ?>aos/2.3.4/aos.js" defer></script>
    <script src="<?php getCDN(); ?>fancyapps-ui/5.0.36/fancybox/fancybox.umd.js" defer></script>
    <script src="<?php $this->options->themeUrl('/js/highlight.min.js?ver=11.9.0'); ?>" defer></script>
    <script>
        document.querySelectorAll('pre code.lang-html').forEach(function(element) {
            element.classList.add('hljs','language-html');
            element.innerText = element.innerText.replace(/&lt;/g,'<').replace(/&gt;/g,'>');
        });    
    </script>
    <script src="<?php $this->options->themeUrl('/js/lazyload.js?ver=202511302'); ?>" defer></script>
    <script src="<?php $this->options->themeUrl('/js/theme.js?ver=20250618'); ?>" defer></script>
</body>
</html>
