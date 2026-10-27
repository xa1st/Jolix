<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <!-- 基础设置 -->
    <meta charset="<?php echo $this->options->charset(); ?>">
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
    <meta name="author" content="<?php $this->options->title(); ?>">
    <meta name="copyright" content="© <?php echo date('Y');?> <?php $this->options->title(); ?>">
    <meta name="robots" content="index,follow">
    <meta name="keywords" content="<?php $this->keywords(); ?>" />
    <meta name="generator" content="<?php $this->options->generator();?>" />
    <meta name="template" content="<?php $this->options->theme();?>" />
    <title><?php $this->archiveTitle(['category' => _t('分类 %s 下的文章'), 'search' => _t('包含关键字 %s 的文章'), 'tag' => _t('标签 %s 下的文章'), 'author' => _t('%s 发布的文章')], '', ' - '); ?><?php $this->options->title(); ?> - <?php $this->options->description(); ?></title>
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php $this->options->siteUrl(); ?>">
    <meta property="og:title" content="<?php $this->options->title(); ?>">
    <meta property="og:description" content="<?php $this->options->description(); ?>">
    <meta property="og:image" content="<?php echo isset($this->options->faviconUrl) && $this->options->faviconUrl ? $this->options->faviconUrl : $this->options->themeUrl . '/images/favicon.ico'; ?>">
    <meta property="og:site_name" content="<?php $this->options->title(); ?>">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php $this->options->title(); ?>">
    <meta name="twitter:description" content="<?php $this->options->description(); ?>">
    <meta name="twitter:keywords" content="<?php $this->options->keywords(); ?>">
    <!-- 浏览器图标 -->
    <link rel="icon" href="<?php echo isset($this->options->faviconUrl) && $this->options->faviconUrl ? $this->options->faviconUrl : $this->options->themeUrl . '/images/favicon.ico'; ?>" type="image/x-icon">
    <link rel="author" href="<?php $this->options->siteUrl(); ?>/about">
    <link rel="canonical" href="<?php $this->options->siteUrl(); ?>">
    <?php if ($this->parameter->type != 404): ?>
    <link rel="alternate" type="application/rss+xml" title="<?php echo $this->archiveTitle;?> &raquo; <?php $this->options->title(); ?> &raquo; RSS 2.0" href="<?php echo $this->feedUrl;?>" />
    <link rel="alternate" type="application/rdf+xml" title="<?php echo $this->archiveTitle;?> &raquo; <?php $this->options->title(); ?> &raquo; RSS 1.0" href="<?php echo $this->feedRssUrl;?>" />
    <link rel="alternate" type="application/atom+xml" title="<?php echo $this->archiveTitle;?> &raquo; <?php $this->options->title(); ?> &raquo; ATOM 1.0" href="<?php echo $this->feedAtomUrl;?>" />
    <?php endif; ?>
    <!-- Style CSS -->
    <?php $this->options->siteCdn = $this->options->siteCdn ?? $this->options->themeUrl . 'libs/'; ?>
    <link rel="stylesheet" href="<?php assetBase(); ?>lxgw-wenkai-screen-webfont/1.7.0/style.css" media="print" onload="this.media='all'"/>
    <link rel="stylesheet" href="<?php assetBase(); ?>aos/2.3.4/aos.css" media="print" onload="this.media='all'"/>
    <link rel="stylesheet" href="<?php assetBase(); ?>fancyapps-ui/5.0.36/fancybox/fancybox.css" media="print" onload="this.media='all'"/>
    <!-- 代码高亮主题 -->
    <link rel="stylesheet" href="<?php assetBase(); ?>highlight.js/11.9.0/styles/a11y-light.min.css" media="print" onload="this.media='all'" id="hljs-light"/>
    <link rel="stylesheet" href="<?php assetBase(); ?>highlight.js/11.9.0/styles/a11y-dark.min.css" media="print" onload="this.media='all'" disabled id="hljs-dark"/>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/css/theme.min.css?ver=2026102801'); ?>"/>
    <?php if ($this->is('single')): ?>
        <script>var respondId='<?php echo $this->respondId;?>', spamStr = <?php echo \Typecho\Common::shuffleScriptVar($this->security->getToken($this->request->getRequestUrl()));?>;</script>
        <?php $commentReply = $this->options->themeUrl . '/js/commentReply.js?var=1'; $antiSpam = $this->options->themeUrl . '/js/antiSpam.js?ver=5';?>
        <?php $this->header("description=&generator=&template&keywords=&rss2=&rss1=&atom=&commentReply={$commentReply}&antiSpam={$antiSpam}"); ?>
    <?php endif ;?>
    <script>const savedTheme=localStorage.getItem("theme")||"auto";const currentTheme=savedTheme==="auto"?(window.matchMedia("(prefers-color-scheme: dark)").matches?"dark auto":"light auto"):savedTheme;document.documentElement.className=currentTheme;</script>
</head>
<body>
