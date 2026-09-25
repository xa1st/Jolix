<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

use Typecho\Widget\Helper\Form\Element\Text;
use Typecho\Widget\Helper\Form\Element\Textarea;

/**
 * Jolix主题功能文件
 */

/**
 * 缓存读取
 */
function cacheGet($key, $default = null) {
    if (class_exists('\TypechoPlugin\MddCache\Plugin')) {
        try {
            $cache = \TypechoPlugin\MddCache\Plugin::getCacheInstance();
            return $cache->get($key, $default);
        } catch (\Exception $e) {
            return $default;
        }
    }
    // 没有插件就不缓存
    return $default;
}

/**
 * 缓存写入
 */
function cacheSet($key, $value, $expire = 36000) {
    if (class_exists('\TypechoPlugin\MddCache\Plugin')) {
        try {
            $cache = \TypechoPlugin\MddCache\Plugin::getCacheInstance();
            return $cache->set($key, $value, $expire);
        } catch (\Exception $e) {
            return false;
        }
    }
    // 没有插件就不缓存
    return false;
}

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
    $siteCdn = new Text('siteCdn', null, '//cdnjs.cloudflare.com/ajax/libs', _t('全站公共库CDN地址'), _t('默认CDN地址，留空则使用本地资源，后面需要带/'));
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
}


// 获取分类的总数量
function getCategoryCount() {
    $db = \Typecho\Db::get();
    return (int)$db->fetchObject($db->select(array('COUNT(mid)' => 'num'))->from('table.metas')->where('type = ?', 'category'))->num;
}

/**
 * 获取博客文章归档
 * 
 * 该函数首先尝试从缓存中获取归档数据，如果缓存未命中或失效，则从数据库中查询最近的200篇文章，
 * 并按年份和月份进行归档整理，最后生成HTML格式的归档列表并写入缓存
 * 先这么写吧，分页之后再优化
 * 
 * @param int $limit 查询文章的数量限制，默认为200
 * 
 * @return string HTML格式的归档列表
 */
function getArchivesList():string {
    $cacheKey = 'archivesList2';
    // 尝试从缓存获取
    $archives = cacheGet($cacheKey);
    if ($archives !== null) return $archives;
    // 获取当前文章数据，前100个
    $posts = \Typecho\Widget::widget('Widget_Contents_Post_Recent', 'pageSize=100')->to($posts);
    $archives = [];
    // 遍历文章
    while ($posts->next()) {
        $date = $posts->date; // 获取文章日期
        $year = $date->format('Y'); // 获取年份
        $monthDay = $date->format('m/d'); // 获取月份和日期
        $archives[$year][$monthDay][] = clone $posts; // 将文章添加到对应的年份和月份
    }
    // 要输出的归档内容
    $content = ''; 
    // 输出归档
    foreach ($archives as $year => $items) {
        // 开头
        $content .= '<h2>' . $year . '年</h2><div class="my-4">';
        // 循环解析到模板
        foreach ($items as $monthDay => $posts) {
            foreach ($posts as $item) {
                $content .= '<a href="' . $item->permalink . '" title="' . $item->title . '" class="block my-2 pl-4"><span class="pr-3 opacity-75">' . $monthDay . '</span>' . $item->title . '</a>';
            }
        }
        $content .= '</div>'; // 结束时间线
    }
    
    // 写入缓存
    cacheSet($cacheKey, $content, 60 * 60 * 24 * 7);
    return $content;
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

/* *
 * 获取CDN
 * @param bool $render 是否输出
 * @return string
 */
function getCDN($render = true) {
    // 获取主题配置
    $options = Helper::options();
    //  获取CDN
    $res = !empty($options->siteCdn) ? $options->siteCdn : $options->themeUrl . '/lib/';
    // 判定是否直接输出
    if (!$render) return $res;
    // 否则返回值
    echo $res;
}

/**
 * 获取社交链接
 * @return array 社交链接数组
 */
function getSocialLinks() {
    $options = \Typecho\Widget::widget('Widget_Options');
    $links = [];
    if (empty($options->socialLinks)) return $links;

    foreach (explode("\n", $options->socialLinks) as $line) {
        $line = trim($line);
        if (empty($line)) continue;

        $parts = explode('|', $line);
        if (count($parts) === 3) {
            $links[] = [
                'name' => trim($parts[0]),
                'url' => trim($parts[1]),
                'icon' => trim($parts[2])
            ];
        }
    }
    return $links;
}

/**
 * 获取侧边栏数据（带缓存）
 * @return array 包含分类、评论、标签的数组
 */
function getSidebarData() {
    $cacheKey = 'sidebarData';
    // 尝试从缓存获取
    $data = cacheGet($cacheKey);
    if ($data !== null) return $data;
    // 查询分类
    $categories = [];
    $categoryWidget = \Typecho\Widget::widget('Widget_Metas_Category_List');
    while ($categoryWidget->next()) {
        $categories[] = [
            'permalink' => $categoryWidget->permalink,
            'name' => $categoryWidget->name,
            'slug' => $categoryWidget->slug,
            'count' => $categoryWidget->count
        ];
    }
    // 查询最新评论
    $comments = [];
    $commentWidget = \Typecho\Widget::widget('Widget_Comments_Recent@latest', 'pageSize=5&ignoreAuthor=true');
    while ($commentWidget->next()) {
        // 获取评论内容摘要
        $text = strip_tags($commentWidget->content);
        // 使用系统原生方法截取内容
        $excerpt = Typecho\Common::subStr(strip_tags($text), 0, 30, '...');
        $comments[] = [
            'permalink' => $commentWidget->permalink,
            'excerpt' => $excerpt,
            'author' => $commentWidget->author,
            'date' => date('Y-m-d', $commentWidget->created)
        ];
    }

    // 查询标签云
    $tagsLists = [];
    \Typecho\Widget::widget('Widget_Metas_Tag_Cloud', ['limit'=>12, 'sort'=>'count', 'order'=>'desc'])->to($tagWidget);
    // 这里有个BUG，在同一个页面取2次值的时候会冲突，后面的limit竟然会失效，我还没空相，先用这个跳过吧
    $i = 0;
    while ($tagWidget->next()) {
        if ($i >= 12) break;
        $tagsLists[] = ['permalink' => $tagWidget->permalink, 'name' => $tagWidget->name, 'count' => $tagWidget->count];
        $i++;
    }
    // 最终结果
    $data = ['categories' => $categories, 'comments' => $comments, 'tags' =>  $tagsLists];
    // 写入缓存
    cacheSet($cacheKey, $data);
    // 返回结果
    return $data;
}

/**
 * 根据文章 ID (cid) 读取其所有评论的 coid 和 author
 *
 * @param int $cid 文章 ID
 * @return array 格式为 ["coid" => "author"] 的数组
 */
function getCommentCoidAuthorMapByCid($cid) {
    // 确保 cid 是有效的整数
    $cid = intval($cid);
    if ($cid <= 0)  return [];
    // 缓存缓存存在，则直接返回
    $cacheKey = 'CommentsList_' . $cid;
    // 如果缓存中存在，则直接返回
    if ($cached = cacheGet($cacheKey)) return $cached;
    // 获取数据库连接，兼容旧版本
    $db = class_exists('\Typecho\Db') ? \Typecho\Db::get() : Typecho_Db::get();
    // 构造查询：选择 coid 和 author 字段
    // 筛选条件：WHERE cid = $cid
    // Typecho 会自动处理 table.comments 的表前缀
    $query = $db->select('coid', 'author')->from('table.comments')->where('cid = ?', $cid);
    // 执行查询并获取所有结果
    // 注意：如果数据库中没有评论，这里会返回一个空数组
    $comments = $db->fetchAll($query);
    // 准备返回的关联数组
    $coidAuthorMap = [];
    // 遍历结果，构建 ["coid" => "author"] 格式的数组
    foreach ($comments as $comment) {
        // 使用 coid 作为数组的键，author 作为值
        // coid 是唯一的，所以不会有键覆盖问题
        $coidAuthorMap[$comment['coid']] = $comment['author'];
    }
    // 写入缓存
    cacheSet($cacheKey, $coidAuthorMap);
    // 返回结果
    return $coidAuthorMap;
}
/** 
 * 获取分类图标列表
 * @return array
*/
function getCategoryIcons() {
    // 获取主题配置
    $options = \Typecho\Widget::widget('Widget_Options');
    // 获取分类图标
    $icons = !empty($options->categoryIcon) ? $options->categoryIcon : '';
    // 将图标字符串按|分割为数组，并去除空白字符
    return $icons ? array_filter(array_map('trim', explode('|', $icons))) : [];
}
?>

