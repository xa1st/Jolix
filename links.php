<?php
/**
 * 友情链接
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
            <h2 class="tit"># 友情链接</h2>
            <div class="desc">朋友们的网站，有空请去踩踩吧 ^_^，排名不分先后，上榜各凭本事，哈哈...</div>
            <div class="friend-link-card">
                <?php if (!empty($this->text)): ?>
                    <?php $content = explode("\n", $this->text);?>
                    <?php foreach ($content as $item):?>
                        <?php $item = explode('|', $item);?>
                        <?php if (count($item) < 5) continue; ?>
                        <?php $name = $item[0] ?? '无名氏'; $url = $item[4] === '0' && !empty($item[5]) ? "https://web.archive.org/web/{$item[5]}/{$item[2]}" : $item[2]; ?>
                        <a data-safe href="<?php echo $url ? "{$url}?ref={$_SERVER['HTTP_HOST']}" : 'javascript:void(0)';?>" target="_blank" title="<?php echo $name; ?> - <?php echo $item[1] ?? ''; ?>" class="link-item">
                            <?php $avatar = '/usr/static/noname.webp';if (!empty($item[3]))  $avatar =  strpos($item[3], '//') !== false ? trim($item[3]) : __TYPECHO_GRAVATAR_PREFIX__ . $item[3] . '?s=64&r=G'; ?>
                            <img src="<?php echo $avatar;?>" alt="<?php echo $name; ?>" class="w-12 h-12 rounded-full mr-4">
                            <div class="info">
                                <div class="link-name"><?php echo $name; ?></div>
                                <div class="link-link"><?php echo $item[1] ?? ''; ?> </div>
                            </div>
                        </a>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </div>
    <!-- 右侧工具栏 -->
    <?php $this->need('sider.php'); ?> 
</div>
<!-- 网页主体结束 -->
<?php $this->need('footer.php'); ?>