<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

use Typecho\Widget;
use Typecho\Widget\Helper\Form\Element\Text;
use Typecho\Widget\Helper\Form\Element\Textarea;

/**
 * Jolix主题功能文件
 */

/** 注册主题自定义字段 */
function themeConfig($form) {
    // 网页favicon地址
    $faviconUrl = new Text('faviconUrl', null, null, _t('favicon.ico 地址'), _t('填写ico格式图片URL地址, 在网站标题前加上一个图标'));
    $form->addInput($faviconUrl);
    // 网站左侧栏头像
    $siteLogoUrl = new Text('siteLogoUrl', null, null, _t('左侧 LOGO 地址'), _t('填写 JPG/PNG/Webp 等图片 URL 地址, 网站左侧头像的显示 (150*150最佳)'));
    $form->addInput($siteLogoUrl);
    // 网站标题配置项
    $siteTitle = new Text('siteTitle', null, null, _t('左侧栏网站标题'), _t('网站左侧栏头像下面的文字'));
    $form->addInput($siteTitle);
    // 左侧描述
    $siteDescription = new Text('siteDescription', null, null, _t('左侧个人描述'), _t('填写自定义描述内容，最好简短，将在网站左侧站名下显示'));
    $form->addInput($siteDescription);
    // 网站分类图标
    $categoryIcon = new Text('categoryIcon', null, '🎯|🧠|🎮|📹|📊', _t('分类图标'), _t('填写自定义分类EMOJI图标，按顺序从左到右，用|分隔，留空则不显示'));
    $form->addInput($categoryIcon);
    // 网站标题配置项
    $siteCdn = new Text('siteCdn', null, '//cdnjs.cloudflare.com/ajax/libs', _t('全站公共库CDN地址'), _t('默认CDN地址，留空则回退到主题本地 libs/ 目录，结尾斜杠可省略'));
    $form->addInput($siteCdn);
    // 网站创建时间
    $siteTime = new Text('siteTime', null, date('Y-m-d H:i:s'), _t('网站创建时间'), _t('格式：YYYY-MM-DD, 用于计算网站运行时间,为空则为今天起算'));
    $form->addInput($siteTime);
    // 社交链接配置
    $socialLinks = new Textarea('socialLinks', null, "GitHub|https://github.com/username|icon-github\nTwitter|https://twitter.com/username|icon-twitter\nEmail|mailto:your@email.com|icon-mail", _t('社交链接'), _t('每行一个，格式：名称|链接|图标类名（fontello图标），留空则不显示'));
    $form->addInput($socialLinks);
    // 网页底部信息
    $footerInfo = new Textarea('footerInfo', null, null, _t('网页底部信息'), _t('填写网页底部的自定义信息，可以包含HTML内容，用br标签换行'));
    $form->addInput($footerInfo);
    // 统计信息
    $statistics = new Textarea('statistics', null, null, _t('统计代码'), _t('填写网页底部的统计代码，如百度统计代码'));
    $form->addInput($statistics);
    // 边栏布局设置
    $sidebarLayout = new Text('sidebarLayout', null, 'comments|tags|readers|posts|links', _t('侧边栏顺序'), _t('填写侧边栏排序，可选：comments, tags, readers, posts, links，按顺序排列，用|分隔，会从上往下'));
    $form->addInput($sidebarLayout);
    // 边栏评论条数
    $commentCount = new Text('commentCount', null, '5', _t('侧边栏最新评配置'), _t('填写侧边栏显示的最新评论条数，默认5条'));
    $form->addInput($commentCount);
    // 边栏标签云条数
    $tagCloud = new Text('tagCloud', null, '20', _t('侧边栏标签云配置'), _t('填写侧边栏显示的标签云条数，默认为20条'));
    $form->addInput($tagCloud);
    // 边栏读者墙条数
    $readers = new Text('readers', null, '10', _t('侧边栏读者墙条数'), _t('填写侧边栏显示的读者墙条数，默认为10条'));
    $form->addInput($readers);
    // 读者墙缓存时间
    $readersCache = new Text('readersCache', null, '7200', _t('读者墙缓存时间'), _t('填写读者墙缓存时间，单位为秒，默认为2小时,填0为不缓存'));
    $form->addInput($readersCache);
    // 边栏最近文章条数
    $recentPosts = new Text('recentPosts', null, '10', _t('侧边栏最近文章条数'), _t('填写侧边栏显示的最近文章条数，默认为10条'));
    $form->addInput($recentPosts);
    // 边栏友情链接条数
    $links = new Text('links', null, '5', _t('侧边栏友情链接条数'), _t('填写侧边栏显示的友情链接条数，默认为5条'));
    $form->addInput($links);
    // 友情链接页slug
    $linksSlug = new Text('linksSlug', null, 'links', _t('友情链接页slug'), _t('填写友情链接页的slug，默认为links'));
    $form->addInput($linksSlug);
    // 归档页文章数量
    $archivesPosts = new Text('archivesPosts', null, '100', _t('归档页文章数量'), _t('填写归档页最多显示的文章数量，默认为100篇'));
    $form->addInput($archivesPosts);
    // 归档页缓存时间
    $archivesCache = new Text('archivesCache', null, '86400', _t('归档页缓存时间'), _t('填写归档页缓存时间，单位为秒，默认为1天,填0为不缓存'));
    $form->addInput($archivesCache);
    // 缓存保存目录
    $cacheDir = new Text('cacheDir', null, 'cache', _t('缓存保存目录'), _t('填写缓存保存目录，默认为cache即/usr/cache，请确保目录存在且可写'));
    $form->addInput($cacheDir);
}

/**
 * 用于左侧的分类数量
 * @return int 分类数量
 */
function getCategoryCount():int {
    // 获取分类列表
    Widget::widget('Widget_Metas_Category_List')->to($categorys);
    // 返回分类数量
    return $categorys->length ?? 0;
}
/**
 * 获取首页左侧社交链接
 * 
 * @return array 社交链接数组
 */
function getSocialLinks(): array {
    // 获取主题配置
    $option = Widget::widget('Widget_Options')->socialLinks ?? '';
    // 如果配置项为空，则返回空数组
    if (!is_string($option) || trim($option) === '') return [];
    // 将配置项按行分割，并过滤掉空行
    return array_values(
        array_filter(
            array_map(
                function ($line) {
                    // 分割行
                    $parts = array_map('trim', explode('|', trim($line), 3));
                    // 如果分割后的数组长度小于3，或者第一项或第二项为空，则返回null
                    if (count($parts) < 3 || $parts[0] === '' || $parts[1] === '') return null;
                    // 返回一个包含名称、链接和图标的数组
                    return ['name' => $parts[0], 'url' => $parts[1], 'icon' => $parts[2]];
                }, 
                preg_split('/\r\n|\r|\n/', $option) // 按行分割
            )
        )
    );
}

/** 
 * 获取分类图标列表
 * @return array
*/
function getCategoryIcons():array {
    // 获取分类图标
    $icons = Widget::widget('Widget_Options')->categoryIcon ?? '';
    // 将图标字符串按|分割为数组，并去除空白字符
    return $icons ? array_filter(array_map('trim', explode('|', $icons))) : [];
}

/**
 * 获取博客文章归档
 * 
 * 该函数首先尝试从缓存中获取归档数据，如果缓存未命中或失效，则从数据库中查询最近的200篇文章，
 * 并按年份和月份进行归档整理，最后生成HTML格式的归档列表并写入缓存
 * 如果缓存命中，则直接返回缓存中的归档列表，避免重复查询数据库，提高性能
 * 
 * @return string HTML格式的归档列表
 */
function getArchivesList():string {
    // 缓存键
    $cacheKey = 'Jolix_archivesList';
    // 如果缓存有值，直接返回
    if ($content = getCache($cacheKey)) return $content;
    // 获取文章数据
    // 初始化归档数组
    $archives = [];
    // 获取主题配置
    $num = intval(Widget::widget('Widget_Options')->archivesPosts ?? 100) ?: 100;
    // 获取最近文章，数量由后台配置
    $posts = Widget::widget('Widget_Contents_Post_Recent', 'pageSize=' . $num)->to($posts);
    // 遍历文章
    while ($posts->next()) {
        $date = $posts->date; // 获取文章日期
        $year = $date->format('Y'); // 获取年份
        $monthDay = $date->format('m/d'); // 获取月份和日期
        $archives[$year][$monthDay][] = clone $posts; // 将文章添加到对应的年份和月份
    }
    // 显示的容器
    $content = '';
    // 输出归档
    foreach ($archives as $year => $items) {
        // 开头
        $content .= '<h2>' . $year . '年</h2><div class="my-4">';
        // 循环解析到模板
        foreach ($items as $monthDay => $posts) {
            foreach ($posts as $item) {
                $content .= '<a href="' . htmlspecialchars($item->permalink, ENT_QUOTES, 'UTF-8') . '" title="' . htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8') . '" class="block my-2 pl-4"><span class="pr-3 opacity-75">' . $monthDay . '</span>' . htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8') . '</a>';
            }
        }
        $content .= '</div>'; // 结束时间线
    }
    // 写入缓存
    setCache($cacheKey, $content, Widget::widget('Widget_Options')->archivesCache ?? 86400);
    // 返回归档内容
    return $content;
}

/**
 * 查询标签云，用于侧边栏显示
 * @return array 标签云数组
 */
function getTagsCloud():array {
    // 查询标签云
    $tagsLists = [];
    // 获取主题配置
    $options = Widget::widget('Widget_Options');
    // 获取标签云条数，默认为20
    $tagCloud = intval($options->tagCloud ?? 20) ?: 20;
    // 使用 Typecho 的 Widget 获取标签云数据
    Widget::widget('Widget_Metas_Tag_Cloud', ['limit'=>$tagCloud, 'sort'=>'count', 'order'=>'desc'])->to($tagWidget);
    // 如果这里是在tags页，会因为存在缓存而导致标签云不会多次查询
    $i = 0;
    while ($tagWidget->next()) {
        if ($i >= $tagCloud) break;
        $tagsLists[] = ['permalink' => $tagWidget->permalink, 'name' => $tagWidget->name, 'count' => $tagWidget->count];
        $i++;
    }
    // 返回标签云数组
    return $tagsLists;
}

/**
 * 查询最新评论，用于侧边栏显示
 */
function getComments():array {
    // 查询最新评论
    $comments = [];
    // 使用 Typecho 的 Widget 获取最新评论，限制为5条，忽略作者自己的评论
    $commentWidget = Widget::widget('Widget_Comments_Recent@latest', 'pageSize=' . (intval(Widget::widget('Widget_Options')->commentCount ?? 5) ?: 5) . '&ignoreAuthor=true');
    // 遍历评论，将每个评论的 permalink、excerpt、author 和 date 添加到数组中
    while ($commentWidget->next()) {
        // 获取评论内容摘要
        $text = strip_tags($commentWidget->content);
        // 使用系统原生方法截取内容
        $excerpt = Typecho\Common::subStr(strip_tags($text), 0, 30, '...');
        // 将评论数据添加到数组中
        $comments[] = [
            'permalink' => $commentWidget->permalink,
            'excerpt' => $excerpt,
            'author' => $commentWidget->author,
            'date' => date('Y-m-d', $commentWidget->created)
        ];
    }
    // 返回最新评论数组
    return $comments;
}

/**
 * 读者墙
 * 统计已通过的读者评论，按邮箱合并，排除站长本人，按评论数从高到低
 * 
 * @param int $limit 显示人数，小于 1 时读主题配置，默认 30
 * @return array 每项包含 author、url、avatar、count
 */
function getReaders(int $limit = 0):array {
    // 初始化数据库
    // 数量从主题配置读，默认30
    if ($limit < 1) $limit = intval(Widget::widget('Widget_Options')->readers ?? 30) ?: 30;
    // 缓存键，不同条数用不同的缓存文件
    $cacheKey = 'Jolix_readers' . $limit;
    // 如果缓存有值，直接返回
    if ($readers = getCache($cacheKey)) return $readers;
    // 初始化数据库
    $db = \Typecho\Db::get();
    // 获取所有管理员（Group 为 administrator）的 uid 和邮箱，提升通用性（不硬编码 uid=1）
    $admins = $db->fetchAll($db->select('uid', 'mail')->from('table.users')->where('group = ?', 'administrator'));
    // 管理员邮箱数组
    $adminUids = array_filter(array_column($admins, 'uid'));
    // 管理员邮箱数组
    $adminMails = array_filter(array_map('trim', array_column($admins, 'mail')));
    // 构建评论统计查询
    $select = $db->select(
            'mail',
            // 取最新一条评论的 author 和 url，避免 MAX() 导致的昵称与网址错配
            'MAX(created) as last_time',
            'COUNT(coid) as num'
        )
        ->from('table.comments')
        ->where('status = ?', 'approved')
        ->where('type = ?', 'comment')
        ->where('mail IS NOT NULL AND mail <> ?', '')
        ->group('mail')
        ->order('num', \Typecho\Db::SORT_DESC)
        ->limit($limit);
    // 排除管理员 uid
    if (!empty($adminUids)) $select->where('authorId NOT IN (?)', $adminUids);
    // 排除管理员邮箱（防止管理员以访客身份填邮箱评论）
    if (!empty($adminMails)) $select->where('mail NOT IN (?)', $adminMails);
    // 开查
    $rows = $db->fetchAll($select);
    // 初始化读者墙数组
    $readers = [];
    // 如果查询结果不为空，且拿出他最后的所有信息
    if (!empty($rows)) {
        // 遍历查询结果
        foreach ($rows as $row) {
            // 获取邮箱
            $mail = $row['mail'];
            // 获取该邮箱最后一次留下的合法昵称和网址
            $latestComment = $db->fetchRow(
                $db->select('author', 'url')
                ->from('table.comments')
                ->where('mail = ?', $mail)
                ->where('status = ?', 'approved')
                ->order('created', \Typecho\Db::SORT_DESC)
                ->limit(1)
            );
            // gravatarUrl 内部会对邮箱做 md5，这里传原始邮箱
            $avatarUrl = \Typecho\Common::gravatarUrl($mail, 128, 'G');
            // 构造读者信息数组
            $readers[] = [
                'author' => $latestComment['author'] ?? '热心网友',
                'url'    => $latestComment['url'] ?? '',
                'avatar' => $avatarUrl,
                'count'  => (int)$row['num'],
                'last_time' => (int)$row['last_time'] // 最后活跃时间
            ];
        }
    }
    // 写入缓存文件
    setCache($cacheKey, $readers, Widget::widget('Widget_Options')->readersCache ?? 7200);
    // 返回读者墙数组
    return $readers;
}

/** 
 * 最近文章列表，用于侧边栏显示
 * 数量是从主题配置中获取的，默认为5
 * 
 * @return array 每项包含 permalink、title、date
 */
function getRecentPosts():array {
    // 缓存键
    static $recentPosts = null;
    // 如果存在直接返回
    if ($recentPosts !== null) return $recentPosts;
    // 查询最新评论
    $recentPosts = [];
    // limit 从配置中读
    $limit = intval(Widget::widget('Widget_Options')->recentPosts ?? 10) ?: 10;
    // 使用 Typecho 的 Widget 获取最新评论，限制为5条，忽略作者自己的评论
    $postWidget = Widget::widget('Widget_Contents_Post_Recent', 'pageSize=' . $limit);
    // 遍历评论，将每个评论的 permalink、excerpt、author 和 date 添加到数组中
    while ($postWidget->next()) {
        // 将评论数据添加到数组中
        $recentPosts[] = [
            'permalink' => $postWidget->permalink,
            'title' => $postWidget->title,
            'date' => date('Y-m-d', $postWidget->created)
        ];
    }
    // 返回最近文章列表
    return $recentPosts;
}

/**
 * 获取友情链接
 * 数据写在 slug 为 links 的独立页面正文里，格式与 links.php 一致
 * 名称|简介|链接|头像(邮箱或图片URL)|失效标记|存档时间
 *
 * 友情链接页的 slug 读后台配置 linksSlug，默认为 links
 *
 * @param int|null $limit 条数：不传读后台「侧边栏友情链接条数」配置(默认5)，传 0 不限制
 * @return array 每项包含 name、desc、url、avatar、dead
 */
function getLinks(?int $limit = null): array {
    // 条数：不传时读后台配置，传 0 表示不限制
    if ($limit === null) $limit = intval(Widget::widget('Widget_Options')->links ?? 5) ?: 5;
    // 按条数分别缓存，友链页(getLinks(0))与侧边栏(getLinks())同页调用时互不影响
    static $cache = [];
    if (isset($cache[$limit])) return $cache[$limit];
    // 获取友情链接页的 slug，默认为 links
    $slug = Widget::widget('Widget_Options')->linksSlug ?? 'links';
    // 按 slug 取页面原文，content() 会过 Markdown，这里要拿 text
    $db = \Typecho\Db::get();
    // 获取链接页面内容
    $page = $db->fetchRow($db->select('text')->from('table.contents')->where('type = ?', 'page')->where('status = ?', 'publish')->where('slug = ?', $slug)->limit(1));
    // 如果页面不存在或没有正文，则返回空数组
    if (empty($page['text'])) return [];
    // 描述在 <!--more--> 之前，链接在之后
    $parts = explode('<!--more-->', $page['text'], 2);
    // 如果没有 <!--more-->，则取整个正文
    $lines = preg_split('/\r\n|\r|\n/', trim($parts[1] ?? ''));
    // 如果没有链接，则返回空数组
    $links = [];
    // 遍历每一行
    foreach ($lines as $line) {
        $item = explode('|', trim($line));
        // 至少要有 名称|简介|链接|头像|失效标记 5 段
        if (count($item) < 5) continue;
        $url = trim($item[2]);
        // 失效标记为 0 且填了存档时间时，改走 web.archive.org
        if ($item[4] === '0' && !empty($item[5])) $url = 'https://web.archive.org/web/' . trim($item[5]) . '/' . $url;
        // 头像是图片地址就直接用，否则按邮箱拼 Gravatar
        $avatar = trim($item[3]);
        // 如果头像地址是邮箱，则用 Gravatar
        $avatar = strpos($avatar, '//') !== false ? $avatar : \Typecho\Common::gravatarUrl($avatar, 64, 'G');
        // 构造链接信息数组
        $links[] = [
            'name'   => trim($item[0]),
            'desc'   => trim($item[1]),
            'url'    => $url,
            'avatar' => $avatar,
            'dead'   => $item[4] === '0',
        ];
        // 达到限制条数时跳出，0 表示不限制
        if ($limit > 0 && count($links) >= $limit) break;
    }
    // 写入本次请求的缓存并返回
    return $cache[$limit] = $links;
}

/**
 * 根据文章 ID (cid) 读取其所有评论的 coid 和 author
 *
 * @param int $cid 文章 ID
 * @return array 格式为 ["coid" => "author"] 的数组
 */
function commentAuthors(int $cid):array {
    // 如果 cid 小于等于 0，则返回空数组
    if ($cid < 1) return [];
    // 初始化数据库
    $db = \Typecho\Db::get();
    // 注意：如果数据库中没有评论，这里会返回一个空数组
    $comments = $db->fetchAll($db->select('coid', 'author')->from('table.comments')->where('cid = ?', $cid));
    $coidAuthorMap = [];
    // 遍历结果，构建 ["coid" => "author"] 格式的数组
    foreach ($comments as $comment) $coidAuthorMap[$comment['coid']] = $comment['author'];
    // 返回结果
    return $coidAuthorMap;
}

/** 
 * 获取copyright的年份 
 * 如果年份相同，则只显示一个年份，否则显示起止年份
 * @return string
 * */
function getCopyrightYear() {
    // 每次获取很麻烦
    static $year = null;
    // 如果已经获取过年份，则直接返回
    if ($year !== null) return $year;
    // 获取站点配置
    $options = Widget::widget('Widget_Options');
    // 获取站点创建时间
    $siteTime = !empty($options->siteTime) ? $options->siteTime : date('Y-m-d H:i:s');
    // 获取当前年份
    $startYear = date('Y', strtotime($siteTime));
    // 获取当前年份
    $currentYear = date('Y');
    // 如果年份相同，则只显示一个年份，否则显示起止年份
    $year = ($startYear === $currentYear) ? $startYear : "{$startYear} - {$currentYear}";
    // 返回年份
    return $year;
}

/**
 * 写入文件缓存
 * @param string $key 缓存键
 * @param mixed $value 缓存值
 * @param int $expire 缓存有效期，单位为秒，默认为0，表示永久有效
 * @return bool 是否写入成功
 */
function setCache(string $key, mixed $value, int $expire = 0): bool {
    // 0 表示不缓存
    if ($expire === 0) return false;
    // 缓存目录，不存在则创建
    $cacheDir = cacheDir();
    if (!is_dir($cacheDir) && !@mkdir($cacheDir, 0755, true)) return false;
    // 缓存文件名
    $cacheFile = $cacheDir . '/' . md5($key) . '.cache';
    // 缓存数据，负数视为永久有效
    $cacheData = ['value' => $value, 'expire' => $expire > 0 ? time() + $expire : 0];
    // 写入缓存文件
    return @file_put_contents($cacheFile, serialize($cacheData)) !== false;
}

/**
 * 读取文件缓存
 * @param string $key 缓存键
 * @return mixed 缓存值，如果缓存不存在或已过期，则返回null
 */
function getCache(string $key): mixed {
    // 缓存文件名，使用md5，防止特殊字符导致文件名不合法
    $cacheFile = cacheDir() . '/' . md5($key) . '.cache';
    // 如果缓存文件不存在，则返回null
    if (!is_file($cacheFile)) return null;
    // 读取缓存文件内容
    $cacheData = @unserialize((string)file_get_contents($cacheFile));
    // 格式不对或已过期则删除并返回null
    if (!is_array($cacheData) || !array_key_exists('value', $cacheData)) {
        @unlink($cacheFile);
        return null;
    }
    // 如果设置了过期时间，并且已经过期，则删除并返回null
    if (!empty($cacheData['expire']) && $cacheData['expire'] < time()) {
        @unlink($cacheFile);
        return null;
    }
    // 返回缓存值
    return $cacheData['value'];
}

/**
 * 缓存目录
 * @return string
 */
function cacheDir(): string {
    $dir = trim((string)(Widget::widget('Widget_Options')->cacheDir ?? 'cache'), '/\\');
    return __TYPECHO_ROOT_DIR__ . '/usr/' . ($dir !== '' ? $dir : 'cache');
}


/**
 * 获取当前主题版本号
 * @return string 主题版本号，格式为 vX.X.X
 */
function getThemeVersion() {
    // 静态变量缓存版本号，避免重复读取文件
    static $version = null;
    // 如果已经缓存了版本号，则直接返回
    if ($version !== null) return $version;
    // 读取主题文件内容
    $themeInfo = @file_get_contents(__DIR__ . '/index.php');
    // 使用正则匹配 @version 后面的版本号
    preg_match('/@version\s+([0-9.]+)/', (string)$themeInfo, $matches);
    // 提取版本号，如果没有匹配到则返回 '未知版本'
    $version = empty($matches[1]) ? '未知版本' : 'v' . (string)$matches[1];
    // 缓存版本号并返回
    return $version;
}

/* *
 * 公共库资源地址（CDN 优先，留空回退本地 libs 目录）
 * @param string $path 库路径，如 'aos/2.3.4/aos.js'
 * @param bool $echo true 直接输出，false 返回字符串
 * @return string|null
 */
function libUrl($path, $echo = true) {
    $options = Widget::widget('Widget_Options');
    // 留空回退本地资源，非空则去掉结尾斜杠统一拼接
    $base = empty($options->siteCdn) ? $options->themeUrl . '/libs/' : rtrim($options->siteCdn, '/');
    // 拼出完整地址
    $url = $base . '/' . ltrim($path, '/');
    // 判定是输出还是返回
    if ($echo) { echo $url; return null; }
    return $url;
}

/**
 * 高性能 UserAgent 解析函数
 * @param string $userAgent
 * @return array ['os' => '操作系统', 'browser' => '浏览器']
 */
function parseUserAgent($userAgent) {
    // 返回值
    $result = ['os' => 'Unknown', 'browser' => 'Unknown'];
    // 操作系统检测 - 用一个正则匹配所有可能的操作系统
    if (preg_match('/(?:Windows NT (\d+\.\d+)|iPhone|iPad|Macintosh|Mac OS X|Android|Linux)/i', $userAgent, $osMatches)) {
        switch (true) {
            case isset($osMatches[1]):
                // Windows 版本映射
                $winVersions = ['10.0' => 'Windows 11', '6.3' => 'Windows 8.1', '6.2' => 'Windows 8', '6.1' => 'Windows 7', '6.0' => 'Windows Vista', '5.1' => 'Windows XP'];
                $result['os'] = $winVersions[$osMatches[1]] ?? 'Windows';
                break;
            case stripos($osMatches[0], 'iPhone') !== false:
                $result['os'] = 'iOS';
                break;
            case stripos($osMatches[0], 'iPad') !== false:
                $result['os'] = 'iPadOS';
                break;
            case stripos($osMatches[0], 'Mac') !== false:
                $result['os'] = 'macOS';
                break;
            case stripos($osMatches[0], 'Android') !== false:
                $result['os'] = 'Android';
                break;
            case stripos($osMatches[0], 'Linux') !== false:
                $result['os'] = 'Linux';
                break;
        }
    }
    
    // 浏览器检测 - 用一个正则匹配所有主流浏览器及版本
    if (preg_match('/(Edg|Edge)\/(\d+)\.|Chrome\/(\d+)\.|Firefox\/(\d+)\.|Version\/(\d+)\..*Safari|MSIE (\d+)\.|rv:(\d+)\..*Trident/i', $userAgent, $browserMatches)) {
        if (!empty($browserMatches[1]) && !empty($browserMatches[2])) {
            // Edge
            $result['browser'] = 'Microsoft Edge ' . $browserMatches[2];
        } elseif (!empty($browserMatches[3])) {
            // Chrome
            $result['browser'] = 'Google Chrome ' . $browserMatches[3];
        } elseif (!empty($browserMatches[4])) {
            // Firefox
            $result['browser'] = 'Mozilla Firefox ' . $browserMatches[4];
        } elseif (!empty($browserMatches[5])) {
            // Safari
            $result['browser'] = 'Apple Safari ' . $browserMatches[5];
        } elseif (!empty($browserMatches[6])) {
            // IE (MSIE)
            $result['browser'] = 'IE ' . $browserMatches[6];
        } elseif (!empty($browserMatches[7])) {
            // IE (Trident)
            $result['browser'] = 'IE ' . $browserMatches[7];
        }
    }
    return $result;
}

/** 
 * 转义 HTML 实体，防止 XSS 攻击
 * @param string $string 待转义的字符串
 */
function escapeHtml(string $string): string {
    return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}