<div align="center">

<h1>🌸 Jolix</h1>

**Typecho 极简三栏主题 · 轻量如光**

简体中文 Jiǎn(简)+ 拉丁语 Lux(光),象征轻量化主题如光般流畅。

基于 **Tailwind CSS 4.1** 构建,支持响应式、深浅色模式、代码高亮、图片灯箱等丰富特性。

[✨ 在线演示](https://bsay.de) · [📦 下载](https://github.com/xa1st/Jolix/releases) · [🐛 Bug 反馈](https://github.com/xa1st/Jolix/issues)

![Typecho](https://img.shields.io/badge/Typecho-%3E%3D1.2-green.svg)
![Tailwind](https://img.shields.io/badge/Tailwind%20CSS-4.1-blue.svg)
![License](https://img.shields.io/badge/License-Mulan%20PSL%20v2-blueviolet.svg)
![Version](https://img.shields.io/badge/Version-1.4.0-orange.svg)

</div>

---

## 特性

- 🧭 **三栏响应式布局** 左侧导航 + 中间内容 + 右侧工具栏(可选显示),移动端自适应
- 🌗 **三态深色模式** 亮色 / 暗色 / 跟随系统,一键循环切换并持久化到 `localStorage`
- ✍️ **霞鹜文楷** 全站字体,优雅的屏幕阅读体验
- 🖼️ **图片懒加载 + 骨架屏** 自带优雅加载动画,失败自动降级
- 📸 **Fancybox 灯箱** 点击图片放大浏览,支持相册浏览
- 💻 **代码高亮** highlight.js + 悬停复制按钮,支持明暗双主题
- 🎬 **AOS 滚动动画** 元素随滚动淡入,`once` 只播一次
- 💬 **增强评论系统** 嵌套回复、@提及、@待回复人高亮、UA 显示、头像 MD5 预览
- 🗂️ **归档页面** 按年月分组,数据库查询结果缓存加速(默认 100 篇)
- 🔤 **分类图标** 可为每个分类配置 Emoji 图标
- 🧑‍💻 **公共库 CDN** 默认 Cloudflare CDN,离线可切换本地资源
- 📊 **阅读量统计** 兼容 `TypechoPlugin\Views` 插件
- 🧠 **AI 课代表** 文章支持 `ai_comment` 字段,输出 AI 总结卡片
- 📦 **高性能缓存** 兼容 `MddCache` 插件,侧栏/归档等数据自动缓存
- 📝 **附设页面** 友链、标签云、说说、外链跳转、404 等独立模板

## 截图

![Jolix 截图](screenshot.png)

## 使用环境

| 依赖 | 要求 |
| --- | --- |
| Typecho | ≥ 1.2(建议最新版) |
| PHP | ≥ 7.4 |
| 浏览器 | 支持 CSS Grid、`:has()` 选择器的现代浏览器 |

## 安装

1. 将主题文件夹重命名为 `Jolix`,放入 Typecho 的 `usr/themes/` 目录
2. 后台 **控制台 → 外观 → 启用主题**
3. 进入 **设置外观** 完成基础配置(见下文)

## 主题设置

进入后台 `设置 → 外观`,可配置以下选项:

| 配置项 | 说明 |
| --- | --- |
| favicon.ico 地址 | 网站图标 URL,可填写 CDN 或本地图片地址 |
| 左侧 LOGO 地址 | 左侧栏头像(推荐 150×150) |
| 左侧栏网站标题 | 头像下方的站名 |
| 左侧个人描述 | 站名下的简短描述 |
| 分类图标 | 按分类顺序填写 Emoji,用 `\|` 分隔,如 `🎯\|🧠\|🎮` |
| 全站公共库CDN地址 | 公共库 CDN 前缀,留空则回退到本地 `libs/` 目录 |
| 网站创建时间 | 格式 `YYYY-MM-DD`,用于计算建站天数 |
| 社交链接 | 每行一条:`名称\|链接\|图标类名`,图标为内置 fontello 图标 |
| 网页底部信息 | 页脚自定义内容,支持 HTML |
| 统计代码 | 底部统计代码,如百度统计 |
| 侧边栏顺序 | 用 `\|` 分隔模块名,按顺序从上到下渲染,可选 `comments`(最新评论)、`tags`(标签云)、`readers`(读者墙)、`posts`(最近文章)、`links`(友情链接),未填写的模块不显示 |
| 侧边栏最新评论条数 | 默认 5 条 |
| 侧边栏标签云条数 | 默认 20 条 |
| 侧边栏读者墙条数 | 默认 10 条 |
| 侧边栏最近文章条数 | 默认 10 条 |
| 侧边栏友情链接条数 | 默认 10 条,数据取自 slug 为 `links` 的友情链接页面 |

**社交图标类名**(内置 fontello 图标库):

`icon-github` · `icon-twitter` · `icon-qq` · `icon-wechat` · `icon-weibo` · `icon-rss` · `icon-mail` · `icon-chrome` · `icon-firefox` · `icon-opera` · `icon-ie`

## 页面模板

Jolix 内置多种自定义页面模板,在后台 **创建页面 → 模板** 中选择:

| 模板 | 说明 |
| --- | --- |
| 关于 | 普通独立页面,渲染文章正文 |
| 归档 | 按年份/月份归档全部文章 |
| 标签 | 标签云 + 可自定义标签描述 |
| 友情链接 | 友链列表,正文格式见下 |
| 说说 | 展示 Says 插件发布的说说法 |

### 友情链接格式

在 **友链页面正文** 中按行填写,每行用 `|` 分隔 6 个字段:

```
名称|简介|链接|头像(邮箱或图片URL)|失效标记|存档时间
```

### 说说页面

需要安装 [Says 评论说说插件](https://github.com/typecho-fans/plugins),并在正文引入:

```html
<!-- 调用示例 -->
<?php \TypechoPlugin\Says\Plugin::render(10, '#says', '/memos/', [...]); ?>
```

主题自带 `says.min.js` / `says.min.css` 与 Says 样式对接。

## 推荐插件

| 插件 | 用途 |
| --- | --- |
| [MddCache](https://github.com/typecho-fans/plugins) | 数据缓存,大幅提升页面响应速度(可选) |
| [Views](https://github.com/typecho-fans/plugins) | 文章阅读量统计(可选) |
| [Says](https://github.com/typecho-fans/plugins) | 说说/动态发布(可选) |

> 未安装缓存插件时主题自动跳过缓存逻辑,不会报错。

## 开发 & 构建

主题样式基于 Tailwind CSS v4 构建:

```bash
# 安装依赖
npm install

# 开发模式(监听 src/tailwind.css 变更,输出未压缩样式)
npm run dev

# 生产构建(输出压缩后的 theme.min.css)
npm run build
```

```
src/tailwind.css      # Tailwind 源样式(@theme 变量、components、utilities)
css/theme.css         # 开发产物
css/theme.min.css     # 生产产物(页面实际引用)
```

> 修改样式后需执行 `npm run build` 并重命名版本参数(`css/theme.min.css?ver=xxxx` 中)以刷新浏览器缓存。

## 文件结构

```
Jolix/
├── index.php           # 首页
├── post.php            # 文章页
├── archive.php         # 分类/标签/搜索归档
├── comments.php        # 评论组件
├── 404.php             # 404 页面
├── go.php              # 外链跳转中转页
├── about.php           # 关于页面模板
├── archives.php        # 归档页面模板
├── tags.php            # 标签云页面模板
├── links.php           # 友链页面模板
├── menu.php            # 左侧栏
├── sider.php           # 右侧栏(搜索、分类固定,其余模块按配置加载)
├── sider/              # 侧边栏模块:comments、tags、readers、posts、links
├── header.php          # 头部
├── footer.php          # 底部
├── functions.php       # 主题功能与配置
├── CHANGELOG.md        # 更新日志
├── css/                # 样式产物
├── src/tailwind.css    # Tailwind 源样式
├── js/                 # 主题 JS
├── fonts/              # fontello 图标字体
├── img/                # 静态图片
└── screenshot.png      # 主题截图
```

## 常见问题

**Q: 如何更换主色调(橙色)?**
在 `src/tailwind.css` 的 `@theme` 块中修改 `--color-orange-500` / `--color-orange-600` 为任意 oklch 或 hex 颜色,重新构建即可;`:root` 与 `.dark` 中的 `--primary` 引用会自动跟随。

**Q: 如何关闭 CDN,使用本地资源?**
后台主题设置将「全站公共库CDN地址」留空即可回退到主题目录下的 `lib/`(需自行放置对应库文件,目录结构与 CDN 保持一致)。评论头像预览使用的 md5 库为主题自带的 `js/md5.min.js`,不受该设置影响。

**Q: 缓存数据不更新怎么办?**
卸载 MddCache 插件或清空其缓存目录;归档(`archivesList`)、侧栏(`siderBar`)、标签(`tagsList`)、评论映射(`CommentsList_cid`)均有独立缓存键。从 1.3.4 起侧栏缓存键由 `siderData` 改为 `siderBar`,旧缓存会自动失效。

## 更新日志

详见 [CHANGELOG.md](CHANGELOG.md)。

## 版权

- 主题源码:© [猫东东](https://github.com/xa1st),以 **木兰宽松许可证 第2版 (Mulan PSL v2)** 开源
- 图标库:fontello(字体图标,见 `fonts/fontello.css`)
- 字体:霞鹜文楷屏幕版(LXGW WenKai Screen)
- 前端依赖:AOS / Fancybox / highlight.js / marked,版权归各自作者所有

[木兰宽松许可证 第2版](LICENSE) © 猫东东(Alex Xu)

---

<p align="center">如果喜欢这个主题,欢迎 ⭐ Star 支持一下~</p>