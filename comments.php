<?php
/**
 * 评论页
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
// 变量赋值
$this->comments()->to($comments);
// 为了传入变量值，做一个助手类
class CommentsAuthorsHelper {
    public static array $authorMap = [];
}
// 存入助手
CommentsAuthorsHelper::$authorMap = getCommentCoidAuthorMapByCid($this->cid);
/**
 * 生成嵌套评论的 HTML 结构
 *
 * @param mixed $comments 评论对象
 * @param array $options 配置选项
 * @return void
 */
function threadedComments($comments, $options):void {
?>
    <!-- 单个评论项 -->
    <li id="li-<?php $comments->theId(); ?>" class="comment-item my-6">
        <!-- 内容主体 -->
        <div id="<?php $comments->theId(); ?>">
            <!-- 这里专门放个容器，可以让留言框在名边儿 -->
            <div class="flex body <?php echo $comments->authorId === 1 ? 'me' : '';?>">
                <!-- 左侧头像 -->
                <img class="avatar" src="<?php echo \Typecho\Common::gravatarUrl($comments->mail, 128, 'G')?>" loading="lazy" alt="评论头像">
                <!-- 右侧内容 -->
                <div class="flex-1 comments_info">
                    <!-- 评论者信息 -->
                    <div class="comments_head flex items-center relative">
                        <a href="<?php echo $comments->url ?? 'javascript:void(0)';?>" class="font-bold" target="_blank" rel="external nofollow" title="点击访问<?php echo $comments->author;?>的主页">
                            <?php echo $comments->author;?>
                        </a>
                        <span class="text-xs ml-3"><?php echo date('Y-m-d', $comments->created);?></span>
                        <!-- 回复按钮 - 右上角 -->
                        <button class="absolute top-0 right-0 text-sm bg-gray-100 hover:bg-gray-200 dark:text-gray-100 dark:bg-gray-600/70 rounded px-2 py-1 transition-colors"><?php $comments->reply();?></button>
                    </div>
                    <!-- 评论内容 -->
                    <div class="comment-content mt-2 mb-4 text-(--text-primary)">
                        <!-- 回复带上要回复人的名字，这里可能需要修改typecho主程序，也可以使用助手方法，但不推荐 -->
                        <?php $commentsAuthors = CommentsAuthorsHelper::$authorMap;?>
                        <?php if ($comments->parent && !empty($commentsAuthors[$comments->parent])):?>
                            <a href="#li-comment-<?php $comments->parent(); ?>" class="reply-to">@<?php echo htmlspecialchars($commentsAuthors[$comments->parent]); ?> </a>
                        <?php endif ?>
                        <?php echo htmlspecialchars(strip_tags($comments->content));?>
                    </div>
                    <!-- 评论额外信息 -->
                    <?php if (function_exists('parseUserAgent')) $agent = parseUserAgent($comments->agent); ?>
                    <div class="comments_meta text-sm text-gray-500 dark:text-gray-500/80 mt-2"><?php echo $agent['os'] ?? '未知系统' ?><span class="px-2">/</span><?php echo $agent['browser'] ?? '未知浏览器' ?></div>
                </div>
            </div>
        </div>
        <!-- 子评论 -->
        <?php echo $comments->children ? '<div class="children">' . $comments->threadedComments($options) . '</div>' : ''; ?>
    </li>
<?php } ?>
<div id="commentbox" class="comment-card bg-white rounded-lg shadow-sm p-6 my-6 dark:bg-black">
    <!-- 评论数量说明 -->
    <h3 class="pb-4 mb-4 border-b border-gray-200 dark:border-gray-600"><?php $this->commentsNum(_t('暂无评论'), _t('仅有 1 条评论'), _t('已有 %d 条评论')); ?></h3>
    <?php if ($this->allow('comment')): ?>
        <!-- 评论框 -->
        <div class="comment-form-card">
            <div id="<?php $this->respondId(); ?>" class="respond mt-3">
                <form method="post" action="<?php $this->commentUrl() ?>" onsubmit="document.getElementById('submit').disabled = true; return true;">
                    <?php if ($this->user->hasLogin()): ?>
                        <div class="pb-2">
                            <?php _e('亲爱的'); ?>
                            <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>,
                            <a href="<?php $this->options->logoutUrl(); ?>" title="Logout">退出 &raquo;</a>
                        </div>
                    <?php else: ?>
                        <!-- 第二行：昵称、邮箱和URL三个输入框 -->
                        <div class="block lg:flex items-center gap-4">
                            <div class="w-10 h-10 hidden lg:block mt-1 mb-2"><img src="<?php echo __TYPECHO_GRAVATAR_PREFIX__;?>0?s=40&r=G" id="cavatar" class="rounded-md" /></div>
                            <div class="flex flex-col flex-1 mt-1 mb-2"><input type="text" name="author" id="cauthor" placeholder="昵称 (必填)" value="<?php echo $this->remember('author', true) ?? ''; ?>" class="comments-input" required></div>
                            <div class="flex flex-col flex-1 mt-1 mb-2"><input type="email" name="mail" id="cmail" placeholder="邮箱 (必填)" value="<?php echo $this->remember('mail', true) ?? ''; ?>"  class="comments-input" required></div>
                            <div class="flex flex-col flex-1 mt-1 mb-2"><input type="url" name="url" id="curl" placeholder="网址 (选填)" class="comments-input"></div>
                        </div>
                    <?php endif; ?>
                    <!-- 评论输入框 -->
                    <textarea name="text" rows="5" placeholder="我相信，评论一定会一针见血..." required class="comments-input" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"><?php $this->remember('text', false); ?></textarea>
                    <!-- 按钮 -->
                    <div class="flex items-center justify-between mt-1 mb-2">
                        <!-- 表情按钮 -->
                        <div class="flex items-center">
                            <div class="w-8 h-8"><!-- 取消表情支持 --><!--<i class="icon icon-face text-2xl"></i>--></div>
                        </div>
                        <!-- 右铡按钮 -->
                        <div class="flex items-center gap-2">
                            <!-- 取消回复 -->
                            <div class="comments-cancel"><?php $comments->cancelReply(); ?></div>
                            <!--  提交 -->
                            <button type="submit" id="submit" class="comments-submit">发表点评</button>
                        </div>
                     </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <!-- 评论列表 -->
    <?php if ($comments->have()): ?>
        <?php $comments->listComments(); ?>
        <div class="page-navigator">
            <?php
                $comments->pageNav(
                    '<i class="icon icon-left"></i>',
                    '<i class="icon icon-right"></i>',
                    1,
                    '...',  // 省略符
                    ['wrapTag' => 'div', 'wrapClass' => 'pagination', 'itemTag' => 'button', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev-btn',  'nextClass' => 'next-btn']
                );
            ?>
        </div>
    <?php endif ?>
</div>
<?php if ($this->allow('comment')): ?>
    <!-- 评论事件 -->
    <script src="//mirrors.sustech.edu.cn/cdnjs/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 获取当前邮件
            const mail = document.getElementById('cmail');
            // 加上监听器
            let timer = null;
            // 监听input的失去焦事件
            if (mail) {
                mail.addEventListener('blur', () => {
                    // 清除之前的计时器
                    clearTimeout(timer);
                    // 防抖
                    timer = setTimeout(() => {
                        // 用正则判定当前值是否为邮件地址
                        if (!/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(mail.value)) return;
                        // 如果不是，则求其md5
                        const avatar_md5 = md5(mail.value);
                        // 然后把头像换成邮件的md5
                        document.getElementById('cavatar').src = `<?php echo __TYPECHO_GRAVATAR_PREFIX__;?>${avatar_md5}?d=mp&s=40`;
                    }, 300); // 延迟300毫秒执行
                });
            }
            // 获取提交按钮元素
            const submitButton = document.getElementById("submit");
            // 获取文本域元素（name="text"的textarea）
            const textarea = document.querySelector('textarea[name="text"]');
            // 为提交按钮添加点击事件监听器
            if (submitButton && textarea) {
                submitButton.addEventListener("click", () => {
                    // 检查文本域中的内容是否为空，如果不为空则改变提交按钮的文本内容
                    if(textarea.value.trim() !== "") submitButton.textContent = "提交中~";
                });
            }
        });
    </script>
<?php endif ?>
