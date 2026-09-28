<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

use Typecho\Widget;
use Typecho\Widget\Helper;
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
    // 边栏评论条数
    $commentCount = new Text('commentCount', null, '5', _t('侧边栏最新评论条数'), _t('填写侧边栏显示的最新评论条数，默认为5'));
    $form->addInput($commentCount);
    // 标签云条数
    $tagCount = new Text('tagCount', null, '20', _t('侧边栏标签云条数'), _t('填写侧边栏显示的标签云条数，默认为20'));
    $form->addInput($tagCount);
}

/**
 * 获取分类数量
 * @return int 分类数量
 */
function getCategoryCount():int {
    $db = \Typecho\Db::get();
    return (int)$db->fetchObject($db->select(array('COUNT(mid)' => 'num'))->from('table.metas')->where('type = ?', 'category'))->num;
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
 * 获取博客文章归档
 * 
 * 该函数首先尝试从缓存中获取归档数据，如果缓存未命中或失效，则从数据库中查询最近的200篇文章，
 * 并按年份和月份进行归档整理，最后生成HTML格式的归档列表并写入缓存
 * 如果缓存命中，则直接返回缓存中的归档列表，避免重复查询数据库，提高性能
 * 
 * @param int $limit 查询文章的数量限制，默认为200
 * 
 * @return string HTML格式的归档列表
 */
function getArchivesList():string {
    // 定义缓存键
    $cacheKey = 'archivesList';
    // 要输出的归档内容
    $content = (string)cacheGet($cacheKey); 
    // 如果 MddCache 插件存在，则使用缓存
    if ($content) return (string)$content;
    // 初始化归档数组
    $archives = [];
    // 获取当前文章数据，前100个
    $posts = Widget::widget('Widget_Contents_Post_Recent', 'pageSize=100')->to($posts);
    // 遍历文章
    while ($posts->next()) {
        $date = $posts->date; // 获取文章日期
        $year = $date->format('Y'); // 获取年份
        $monthDay = $date->format('m/d'); // 获取月份和日期
        $archives[$year][$monthDay][] = clone $posts; // 将文章添加到对应的年份和月份
    }
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
    cacheSet($cacheKey, $content, 60 * 60 * 24 * 30); // 缓存一个月，直到主动删除
    // 返回归档内容
    return $content;
}

/**
 * 获取侧边栏数据（带缓存）
 * @return array 包含分类、评论、标签的数组
 */
function getSidebarData():array {
    // 定义缓存键
    $cacheKey = 'siderBar';
    // 判定插件是否存在
    $siderdata = cacheGet($cacheKey);
    // 如果 MddCache 插件存在，则使用缓存
    if ($siderdata) return (array)$siderdata;
    // 查询分类
    $categories = getCategoriesList();
    // 查询最新评论
    $comments = getCommentsList();
    // 查询标签云
    $tags = getTagsCloud();
    // 最终结果
    $data = ['categories' => $categories, 'comments' => $comments, 'tags' => $tags];
    // 写入缓存
    cacheSet($cacheKey, $data, 60 * 60 * 24 * 7); // 缓存一周，直到主动删除
    // 返回结果
    return $data;
}

/** 
 * 查询分类列表，用于侧边栏显示
 * @return array 分类数组
 */
function getCategoriesList():array {
    // 查询分类列表
    $categories = [];
    // 使用 Typecho 的 Widget 获取分类列表
    $categoryWidget = Widget::widget('Widget_Metas_Category_List');
    // 遍历分类列表，将每个分类的 permalink、name、slug 和 count 添加到数组中
    while ($categoryWidget->next()) {
        // 将分类数据添加到数组中
        $categories[] = ['permalink' => $categoryWidget->permalink, 'name' => $categoryWidget->name, 'slug' => $categoryWidget->slug, 'count' => $categoryWidget->count];
    }
    // 返回分类数组
    return $categories;
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
    $tagCount = $options->tagCount ?? 20;
    // 使用 Typecho 的 Widget 获取标签云数据
    Widget::widget('Widget_Metas_Tag_Cloud', ['limit'=>$tagCount, 'sort'=>'count', 'order'=>'desc'])->to($tagWidget);
    // 如果这里是在tags页，会因为存在缓存而导致标签云不会多次查询
    $i = 0;
    while ($tagWidget->next()) {
        if ($i >= $tagCount) break;
        $tagsLists[] = ['permalink' => $tagWidget->permalink, 'name' => $tagWidget->name, 'count' => $tagWidget->count];
        $i++;
    }
    // 返回标签云数组
    return $tagsLists;
}

/**
 * 查询最新评论，用于侧边栏显示
 */
function getCommentsList():array {
    // 查询最新评论
    $comments = [];
    // 使用 Typecho 的 Widget 获取最新评论，限制为5条，忽略作者自己的评论
    $commentWidget = Widget::widget('Widget_Comments_Recent@latest', 'pageSize=' . (Widget::widget('Widget_Options')->commentCount ?? 5) . '&ignoreAuthor=true');
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
 * 根据文章 ID (cid) 读取其所有评论的 coid 和 author
 *
 * @param int $cid 文章 ID
 * @return array 格式为 ["coid" => "author"] 的数组
 */
function getCommentCoidAuthorMapByCid(int $cid):array {
    // 确保 cid 是有效的整数
    $cid = intval($cid);
    // 如果 cid 小于等于 0，则返回空数组
    if ($cid < 1)  return [];
    // 缓存缓存存在，则直接返回
    $cacheKey = 'CommentsList_' . $cid;
    // 定义容器
    $coidAuthorMap = [];
    // 如果缓存中存在，则直接返回
    $coidAuthorMap = (array)cacheGet($cacheKey);
    // 如果缓存中存在，则直接返回
    if (!empty($coidAuthorMap)) return $coidAuthorMap;
    // 初始化数据库
    $db = \Typecho\Db::get();
    // 注意：如果数据库中没有评论，这里会返回一个空数组
    $comments = $db->fetchAll($db->select('coid', 'author')->from('table.comments')->where('cid = ?', $cid));
    // 遍历结果，构建 ["coid" => "author"] 格式的数组
    foreach ($comments as $comment) $coidAuthorMap[$comment['coid']] = $comment['author'];
    // 写入缓存
    cacheSet($cacheKey, $coidAuthorMap);
    // 返回结果
    return $coidAuthorMap;
}

/** 
 * 获取分类图标列表
 * @return array
*/
function getCategoryIcons():array {
    // 获取主题配置
    $options = Widget::widget('Widget_Options');
    // 获取分类图标
    $icons = !empty($options->categoryIcon) ? $options->categoryIcon : '';
    // 将图标字符串按|分割为数组，并去除空白字符
    return $icons ? array_filter(array_map('trim', explode('|', $icons))) : [];
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

/** 
 * 缓存插件是否存在 
 * 
 * @param string 变量名称，用于判断缓静态变量是否存在
 * @return bool
 * 
 */
function isCachePluginExists():bool {
    // 静态变量缓存插件是否存在
    static $exists = null;
    // 如果已经判断过插件是否存在，则直接返回结果
    if ($exists !== null) return $exists;
    // 判断插件是否存在
    $exists = class_exists('\TypechoPlugin\MddCache\Plugin');
    // 返回结果
    return $exists;
}

/**
 * 缓存读取
 * 如果 MddCache 插件存在，则使用缓存，否则不缓存
 * 
 * @param string $key 缓存键
 * @param mixed $default 缓存默认值
 * @return mixed 返回缓存值，如果缓存不存在则返回默认值
 * 
 */
function cacheGet($key, $default = null) {
    // 如果缓存键为空，则直接返回默认值
    if (empty($key)) return $default;
    // 如果 MddCache 插件存在，则使用缓存
    return isCachePluginExists() ? \TypechoPlugin\MddCache\Plugin::getCacheInstance()->get($key, $default) : $default;
}

/**
 * 缓存写入
 * 
 * @param string $key 缓存键
 * @param mixed $value 缓存值
 * @param int $expire 缓存过期时间，单位为秒，默认为30天
 * @return bool 返回缓存写入是否成功
 * 
 */
function cacheSet($key, $value, $expire = 60 * 60 * 24 * 30):bool {
    // 如果 MddCache 插件存在，则使用缓存
    return isCachePluginExists() ? \TypechoPlugin\MddCache\Plugin::getCacheInstance()->set($key, $value, $expire) : false;
}

/**
 * 判断插件是否存在
 * @param string $pluginName 插件名称
 * @return bool
 */
function isPluginExists($pluginName) {
    // 判断插件是否存在
    return class_exists('\TypechoPlugin\MddCache\Plugin');
}

/* *
 * 获取CDN
 * @param bool $render 是否输出
 * @return string
 */
function getCDN($render = true) {
    // 获取主题配置
    $options = Widget::widget('Widget_Options');
    //  获取CDN
    $res = !empty($options->siteCdn) ? $options->siteCdn : $options->themeUrl . '/lib/';
    // 判定是否直接输出
    if (!$render) return $res;
    // 否则直接输出
    echo $res;
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
?>

