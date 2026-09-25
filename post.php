<?php
/**
 * 文章内页
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
    <div class="main-content page-post w-full lg:flex-1 lg:mx-6 overflow-hidden">
        <div class="blog-card bg-white rounded-lg shadow-sm p-4 lg:p-6 mb-6 dark:bg-black">
            <!-- 博客标题 -->
            <h2 class="post-title text-center"><a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a></h2>
            <!-- 增加字段 -->
            <div class="meta text-center text-sm">
                <?php $this->date(); ?><span class="px-2">/</span><?php $this->category(','); ?><span class="px-2">/</span>共<?php echo mb_strlen($this->text); ?>字<span class="px-2">/</span><?php $this->commentsNum('暂无评论', '1条热评', '%d条热评'); ?>
            </div>
            <!-- 博客内容  -->
            <div class="post-content">
                <?php $this->content(); ?>
                <div class="over flex justify-center items-center mb-2 mt-8 text-gray-500/60 text-md">正文完</div>
            </div>
            <!-- 附加内容 -->
            <div class="text-left"><i class="icon icon-tags pr-2"></i><?php $this->tags('，', true, 'none'); ?></div>
        </div>
        <!-- AI课代表 开始 -->
        <?php $aiComment = json_decode((string)$this->fields->ai_comment, true); ?>
        <?php if (isset($aiComment['say']) && !empty($aiComment['say'])): ?>
            <div class="gemini-card bg-white rounded-lg shadow-sm p-6 mb-6 dark:bg-black overflow-hidden">
                <h2 class="text-lg font-medium mb-4 pb-2 border-b border-gray-200 dark:border-gray-600/50 relative">
                    AI课代表总结
                    <span class="absolute right-0 top-2 opacity-60 text-md hidden md:block"><?php echo htmlspecialchars($aiComment['ainame'] ?? '无名氏'); ?></span>
                </h2>
                <p class="leading-8"><?php echo htmlspecialchars($aiComment['say']); ?></p>
            </div>
        <?php endif; ?>
        <!-- AI课代表 结束 -->
        <!-- 版权声明 -->
        <div class="ccc-card bg-white rounded-lg shadow-sm p-6 mb-6 dark:bg-black overflow-hidden relative">
            <i class="icon icon-cc -top-5 -right-8 left-auto w-auto text-9xl opacity-5 -rotate-[40deg] absolute" ></i>
            本作品采用 <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh" target="_blank" rel="noopener noreferrer">知识共享署名-非商业性使用-相同方式共享 4.0 国际许可协议</a> 进行许可。
        </div>
        <!-- 评论框 -->
        <?php $this->need('comments.php'); ?>
    </div>
    <!-- 右侧工具栏 -->
    <?php $this->need('sider.php'); ?> 
</div>
<?php $this->need('footer.php'); ?>
