<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <!-- 基础设置 -->
    <meta charset="<?php echo $options->charset(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="HandheldFriendly" content="True">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <!-- 移动端Web App设置 -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">
    <!-- SEO相关 -->
    <meta name="author" content="<?php $options->title(); ?>">
    <meta name="copyright" content="© <?php echo date('Y'); ?> <?php $options->title(); ?>">
    <meta name="robots" content="index,follow">
    <meta name="generator" content="<?php $options->generator(); ?>" />
    <meta name="template" content="<?php $options->theme(); ?>" />
    <title><?php echo $plugin->title; ?> - <?php $options->title(); ?> - <?php $options->description(); ?></title>
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php $options->siteUrl(); ?>">
    <meta property="og:title" content="<?php $options->title(); ?>">
    <meta property="og:description" content="<?php $options->description(); ?>">
    <meta property="og:image" content="<?php echo isset($options->faviconUrl) && $options->faviconUrl ? $options->faviconUrl : $options->themeUrl . '/images/favicon.ico'; ?>">
    <meta property="og:site_name" content="<?php $options->title(); ?>">
    <!-- 浏览器图标 -->
    <link rel="icon" href="<?php echo isset($options->faviconUrl) && $options->faviconUrl ? $options->faviconUrl : $options->themeUrl . '/images/favicon.ico'; ?>" type="image/x-icon">
    <link rel="author" href="<?php $options->siteUrl(); ?>/about">
    <link rel="canonical" href="<?php $options->siteUrl(); ?>">
    <link rel="alternate" type="application/rss+xml" title="<?php echo $this->archiveTitle; ?> &raquo; <?php $options->title(); ?> &raquo; RSS 2.0" href="<?php echo $this->feedUrl; ?>" />
    <link rel="alternate" type="application/rdf+xml" title="<?php echo $this->archiveTitle; ?> &raquo; <?php $options->title(); ?> &raquo; RSS 1.0" href="<?php echo $this->feedRssUrl; ?>" />
    <link rel="alternate" type="application/atom+xml" title="<?php echo $this->archiveTitle; ?> &raquo; <?php $options->title(); ?> &raquo; ATOM 1.0" href="<?php echo $this->feedAtomUrl; ?>" />
    <!-- Style CSS -->
    <?php $options->siteCdn = $options->siteCdn ?? $options->themeUrl . 'libs/'; ?>
    <link rel="stylesheet" href="<?php echo $options->siteCdn; ?>lxgw-wenkai-screen-webfont/1.7.0/style.css" />
    <link rel="stylesheet" href="<?php $options->themeUrl('/css/theme.min.css?ver=202506072'); ?>" />
    <script>
        const savedTheme = localStorage.getItem("theme") || "auto";
        const currentTheme = savedTheme === "auto" ? (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark auto" : "light auto") : savedTheme;
        document.documentElement.className = currentTheme;
    </script>
</head>

<body class="min-h-screen bg-custom-gray-50 dark:bg-custom-dark flex items-center justify-center p-4 transition-colors duration-300">
    <div class="w-full max-w-md">
        <!-- 主要内容卡片 -->
        <div class="bg-white dark:bg-black rounded-2xl p-8 shadow-2xl dark:shadow-gray-900/50 fade-in hover-lift border border-gray-100 dark:border-gray-800">
            <!-- 标题 -->
            <div class="text-center mb-6">
                <p class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2"><span id="countdown">5</span>秒后即将离开本站</p>
                <p class="text-gray-500 dark:text-gray-400 text-md">目标安全性未知，请谨慎访问</p>
            </div>
            <!-- URL 显示 -->
            <div class="mb-6">
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                    <div class="text-md text-gray-700 dark:text-gray-300 break-all font-mono text-center" id="targetUrl"><?php echo htmlspecialchars($target, ENT_QUOTES); ?></div>
                </div>
            </div>
            <!-- 按钮组 -->
            <div class="space-y-3">
                <button onclick="redirectNow()" class="w-full bg-orange-500 hover:bg-orange-500 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl">
                    立即访问
                </button>
            </div>
        </div>
        <!-- 底部说明 -->
        <div class="mt-4 text-center">
            &copy; <?php echo date('Y'); ?> <?php $options->title(); ?>
        </div>
        <!-- 统计代码 -->
        <?php echo $options->statistics; ?>
    </div>
    <script>
        // 倒计时功能
        let countdown = 5;
        // 倒计时对象
        const countdownElement = document.getElementById('countdown');
        // 直接跳转
        const redirectNow = () => {
            clearInterval(timer);
            window.location.href = <?php echo json_encode($target, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
        };
        const timer = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;
            if (countdown <= 0) {
                clearInterval(timer);
                redirectNow();
            }
        }, 1000);
    </script>
</body>

</html>
