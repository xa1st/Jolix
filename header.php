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
    <title><?php $this->archiveTitle(['category' => _t('分类 %s 下的文章'), 'search' => _t('包含关键字 %s 的文章'), 'tag' => _t('标签 %s 下的文章'), 'author' => _t('%s 发布的文章')], '', ' - '); ?><?php $this->options->title(); ?> - <?php $this->options->description(); ?></title>
    <!-- 浏览器图标 -->
    <link rel="icon" href="<?php echo isset($this->options->faviconUrl) && $this->options->faviconUrl ? $this->options->faviconUrl : $this->options->themeUrl . '/assets/img/favicon.ico'; ?>" sizes="32x32" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="128x128" href="<?php echo $this->options->themeUrl . '/assets/img/128.png'; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->options->themeUrl . '/assets/img/180.png'; ?>">
    <!-- 版权声明 -->
    <link rel="author" href="<?php $this->options->siteUrl('about'); ?>">
    <link rel="canonical" href="<?php $this->options->siteUrl(); ?>">
    <!-- 主题补充头部代码 -->
    <meta property="og:description" content="<?php $this->options->description(); ?>">
    <meta property="og:image" content="<?php $this->options->themeUrl('assets/img/jolix.png'); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <!-- 主题头部代码 -->
    <?php $this->header(); ?>
    <!-- 全局字体 -->
    <link rel="stylesheet" href="<?php libUrl('lxgw-wenkai-screen-webfont/1.7.0/style.css'); ?>" media="print" onload="this.media='all'"/>
    <!-- 高亮和动画 -->
    <link rel="stylesheet" href="<?php libUrl('aos/2.3.4/aos.css'); ?>" media="print" onload="this.media='all'"/>
    <link rel="stylesheet" href="<?php libUrl('fancyapps-ui/6.0.33/fancybox/fancybox.min.css'); ?>" media="print" onload="this.media='all'"/>
    <!-- 代码高亮主题 -->
    <link rel="stylesheet" href="<?php libUrl('highlight.js/11.11.0/styles/a11y-light.min.css'); ?>" media="print" onload="this.media='all'" id="hljs-light"/>
    <link rel="stylesheet" href="<?php libUrl('highlight.js/11.11.0/styles/a11y-dark.min.css'); ?>" media="print" onload="this.media='all'" disabled id="hljs-dark"/>
    <!-- 主题样式 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/theme.min.css'); ?>"/>
    <!-- 主题自定义头部代码 -->
    <script>const savedTheme=localStorage.getItem("theme")||"auto";const currentTheme=savedTheme==="auto"?(window.matchMedia("(prefers-color-scheme: dark)").matches?"dark auto":"light auto"):savedTheme;document.documentElement.className=currentTheme;</script>
</head>
<body>

