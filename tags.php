<?php
/**
 * 标签页
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
            <h2 class="mb-6 pb-2 border-b border-gray-200 text-left dark:border-gray-600/70"># 标签</h2>
            <?php if (!empty($this->text)): ?><div class="mb-6 leading-8 text-wrap"><?php $this->content(); ?></div><?php endif;?>
            <div class="tags">
                <?php
                    // 缓存标签列表，减少数据库查询
                    $tagsList = getCache('Jolix_tags');
                    // 缓存不存在，则重新获取
                    if (!is_array($tagsList)) {
                        $tagsList = [];
                        $tags = $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1');
                        while($tags->next()) {
                            $tagsList[] = ['name' => $tags->name, 'count' => $tags->count, 'permalink' => $tags->permalink];
                        }
                        setCache('Jolix_tags', $tagsList, 86400);
                    }
                ?>
                <?php foreach ($tagsList as $tag): ?>
                    <a href="<?php echo $tag['permalink']; ?>" class="tag" data-aos="zoom-in" data-aos-delay="50" title="标签「<?php echo $tag['name']; ?>」共有<?php echo $tag['count']; ?>篇文章"> 
                        <?php echo $tag['name']; ?> <span class="num">(<?php echo $tag['count']; ?>)</span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- 右侧工具栏 -->
    <?php $this->need('sider.php'); ?>
</div>
<!-- 网页主体结束 -->
<?php $this->need('footer.php'); ?>
