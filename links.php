<?php
/**
 * 友情链接(单页版)
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
            <h2 class="tit"># <?php $this->title() ?></h2>
            <?php
                $text = explode("<!--more-->", $this->text); // 分割文本内容
                $description = trim($text[0]); // 获取描述部分
                $links = getLinks(0); // 链接数据统一由 getLinks() 解析，0 表示不限制条数
            ?>
            <!-- 如果描述不为空，则显示描述 -->
            <?php if (!empty($description)): ?><div class="desc"><?php echo $description; ?></div><?php endif; ?>
            <div class="friend-link-card">
                <?php foreach ($links as $link):?>
                    <?php
                        $name = $link['name'] !== '' ? $link['name'] : '无名氏';
                        $host = escapeHtml($_SERVER['HTTP_HOST'] ?? '');
                        $url = $link['url'] ? escapeHtml($link['url']) . "?ref={$host}" : 'javascript:void(0)';
                    ?>
                    <a data-safe href="<?php echo $url; ?>" target="_blank" title="<?php echo escapeHtml($name . ' - ' . $link['desc']); ?>" class="link-item">
                        <img src="<?php echo escapeHtml($link['avatar']); ?>" alt="<?php echo escapeHtml($name); ?>" class="w-12 h-12 rounded-full mr-4">
                        <div class="info">
                            <div class="link-name"><?php echo escapeHtml($name); ?></div>
                            <div class="link-link"><?php echo escapeHtml($link['desc']); ?> </div>
                        </div>
                    </a>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <!-- 右侧工具栏 -->
    <?php $this->need('sider.php'); ?> 
</div>
<!-- 网页主体结束 -->
<?php $this->need('footer.php'); ?>