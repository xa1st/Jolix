<div align="center">

<h1>🌸 Jolix</h1>

**Typecho 极简三栏主题 · 轻量如光**

简体中文 Jiǎn(简)+ 拉丁语 Lux(光),象征轻量化主题如光般流畅。

基于 **Tailwind CSS 4.1** 构建,支持响应式、深浅色模式、代码高亮、图片宫格与灯箱等丰富特性。

[✨ 在线演示](https://bsay.de) · [📦 下载](https://github.com/xa1st/Jolix/releases) · [🐛 Bug 反馈](https://github.com/xa1st/Jolix/issues)

![Typecho](https://img.shields.io/badge/Typecho-%3E%3D1.2-green.svg)
![Tailwind](https://img.shields.io/badge/Tailwind%20CSS-4.1-blue.svg)
![License](https://img.shields.io/badge/License-Mulan%20PSL%20v2-blueviolet.svg)
![Version](https://img.shields.io/badge/Version-1.4.6.0-orange.svg)

</div>

---

## 版本号说明

Jolix 采用四段式版本号 `主版本.次版本.功能版本.修订版本`,如 `1.4.6.0`:

- 前三段:功能版本,有新功能或较大调整时递增
- 第四段:`0` 表示稳定版本,非 `0` 表示在对应稳定版之上修 BUG 的版本(如 `1.4.6.1`)

## 特性

- 🧭 **三栏响应式布局** 左侧导航 + 中间内容 + 右侧工具栏(可选显示),移动端自适应
- 🌗 **三态深色模式** 亮色 / 暗色 / 跟随系统,一键循环切换并持久化到 `localStorage`
- ✍️ **霞鹜文楷** 全站字体,优雅的屏幕阅读体验
- 🖼️ **图片懒加载 + 骨架屏** 自带优雅加载动画,失败自动降级
- 🧩 **图片宫格** 正文手写 `<figure class="pg-4">` 即可让 1~9 张图按固定布局排列,同组等高裁切,支持图注,移动端独立排版(见常见问题)
- 📸 **Fancybox 灯箱** 点击图片放大浏览,按段落/宫格自动分组相册
- 💻 **代码高亮** highlight.js + 悬停复制按钮,支持明暗双主题
- 🎬 **AOS 滚动动画** 元素随滚动淡入,`once` 只播一次
- 💬 **评论系统** Typecho 原生嵌套回复 + @提及、@待回复人高亮、UA 显示、头像 MD5 实时预览
- 🌐 **社交分享卡** 内置 1200×630 分享图(`og:image`)与多尺寸站点图标(favicon / 高分屏 / iOS 主屏)
- 🗂️ **归档页面** 按年月分组,查询结果写入文件缓存(默认最多 100 篇)
- 🔤 **分类图标** 可为每个分类配置 Emoji 图标
- 🧑‍💻 **公共库 CDN** 默认 CDN 地址,留空回退主题内置本地库(AOS / Fancybox / highlight.js / marked)
- 📊 **阅读量统计** 兼容 `TypechoPlugin\Views` 插件
- 🧠 **AI 课代表** 文章支持 `ai_comment` 字段,输出 AI 总结卡片
- 📦 **文件缓存** 归档、读者墙、标签页写入主题缓存目录,填 `0` 可关闭
- 📝 **附设页面** 留言本、友链、标签云、归档、404 等独立页面模板

## 截图

![Jolix 截图](screenshot.png)

## 使用环境

| 依赖 | 要求 |
| --- | --- |
| Typecho | ≥ 1.2(建议最新版) |
| PHP | ≥ 7.4 |
| 浏览器 | 支持 CSS Grid、`:has()` 选择器的现代浏览器 |

## 安装

1. 将主题文件夹命名为 `Jolix`,放入 Typecho 的 `usr/themes/` 目录
2. 后台 **控制台 → 外观 → 启用主题**
3. 进入 **设置外观** 完成基础配置(见下文)

## 主题设置

进入后台 `设置 → 外观`,可配置以下选项:

| 配置项 | 说明 |
| --- | --- |
| favicon.ico 地址 | 网站图标 URL,可填写 CDN 或本地图片地址;留空使用主题内置图标 |
| 左侧 LOGO 地址 | 左侧栏头像(推荐 150×150) |
| 左侧栏网站标题 | 头像下方的站名 |
| 左侧个人描述 | 站名下的简短描述 |
| 分类图标 | 按分类顺序填写 Emoji,用 `\|` 分隔,如 `🎯\|🧠\|🎮` |
| 全站公共库CDN地址 | 公共库 CDN 前缀,留空则回退到本地 `libs/` 目录,结尾斜杠可省略 |
| 网站创建时间 | 格式 `YYYY-MM-DD`,用于计算建站天数 |
| 社交链接 | 每行一条:`名称\|链接\|图标类名`,图标为内置 fontello 图标 |
| 网页底部信息 | 页脚自定义内容,支持 HTML |
| 统计代码 | 底部统计代码,如百度统计 |
| 侧边栏顺序 | 用 `\|` 分隔模块名,按顺序从上到下渲染,可选 `comments`(最新评论)、`tags`(标签云)、`readers`(读者墙)、`posts`(最近文章)、`links`(友情链接),未填写的模块不显示 |
| 侧边栏最新评论条数 | 默认 5 条 |
| 侧边栏标签云条数 | 默认 20 条 |
| 侧边栏读者墙条数 | 默认 10 条 |
| 读者墙缓存时间 | 单位秒,默认 7200(2 小时),填 `0` 不缓存 |
| 侧边栏最近文章条数 | 默认 10 条 |
| 侧边栏友情链接条数 | 默认 5 条,数据取自友情链接页正文 |
| 友情链接页 slug | 默认 `links`,对应独立页面的缩略名 |
| 归档页文章数量 | 归档页最多列出的文章数,默认 100 篇 |
| 归档页缓存时间 | 单位秒,默认 86400(1 天),填 `0` 不缓存 |
| 缓存保存目录 | 相对 `usr/` 的目录名,默认 `cache`,即 `usr/cache` |

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
| 留言本 | 页面正文 + 评论框 |

### 友情链接格式

在 **友链页面正文** 中按行填写,每行用 `|` 分隔 6 个字段:

```
名称|简介|链接|头像(邮箱或图片URL)|失效标记|存档时间
```

- 头像字段填邮箱则走 Gravatar,填图片 URL(含 `//`)则直接使用
- 失效标记填 `0` 且填写了存档时间时,链接自动改走 web.archive.org 存档

## 推荐插件

| 插件 | 用途 |
| --- | --- |
| [Views](https://github.com/typecho-fans/plugins) | 文章阅读量统计(可选) |
| [Says](https://github.com/typecho-fans/plugins) | 说说/动态发布(可选) |

> 1.4.2 起缓存由主题自己写入文件,不再需要 MddCache。

## 开发 & 构建

主题样式基于 Tailwind CSS v4 构建:

```bash
# 安装依赖
npm install

# 开发模式(监听 src/theme.css 变更,输出未压缩样式)
npm run dev

# 生产构建(样式 + 脚本,一次全部输出)
npm run build
```

```
src/theme.css            # Tailwind 源样式(@theme 变量、components、utilities)
src/theme.js             # 主题脚本源码(深浅色、懒加载、灯箱等)
assets/css/theme.css     # 开发产物(未压缩)
assets/css/theme.min.css # 生产产物(页面实际引用)
assets/js/theme.min.js   # 主题脚本生产产物(页面实际引用)
assets/js/md5.min.js     # 评论头像预览依赖(页面实际引用)
```

> 修改源码后需执行 `npm run build`,并同步更换模板中的缓存版本参数(`?ver=xxxx`)以刷新浏览器缓存。

## 文件结构

```
Jolix/
├── index.php           # 首页
├── post.php            # 文章页
├── archive.php         # 分类/标签/搜索归档
├── comments.php        # 评论组件
├── 404.php             # 404 页面
├── about.php           # 关于页面模板
├── archives.php        # 归档页面模板
├── tags.php            # 标签云页面模板
├── links.php           # 友链页面模板
├── gbook.php           # 留言本页面模板
├── menu.php            # 左侧栏
├── sider.php           # 右侧栏(搜索、分类固定,其余模块按配置加载)
├── sider/              # 侧边栏模块:comments、tags、readers、posts、links
├── header.php          # 头部(图标、og 分享标签)
├── footer.php          # 底部(公共库脚本加载)
├── functions.php       # 主题功能与配置(libUrl、缓存等)
├── CHANGELOG.md        # 更新日志
├── assets/             # 构建产物:css、js、fonts、img(站点图标与分享图)
├── libs/               # 本地公共库:aos、fancyapps-ui、highlight.js、marked
├── src/                # 源码:theme.css、theme.js
└── screenshot.png      # 主题截图(Typecho 后台预览用,勿改名/移动)
```

`assets/img/` 内置图标一览:

| 文件 | 尺寸 | 用途 |
| --- | --- | --- |
| `favicon.ico` | 32×32 | 传统 favicon |
| `128.png` | 128×128 | 高分屏标签栏图标 |
| `180.png` | 180×180 | iOS 添加到主屏幕 |
| `192.png` / `512.png` | 192 / 512 | PWA 图标(预留,当前未启用 manifest) |
| `jolix.png` | 1200×630 | 社交分享卡 `og:image` |

## 常见问题

**Q: 如何更换主色调(橙色)?**
在 `src/theme.css` 的 `@theme` 块中修改 `--color-orange-500` / `--color-orange-600` 为任意 oklch 或 hex 颜色,重新构建即可;`:root` 与 `.dark` 中的 `--primary` 引用会自动跟随。

**Q: 如何更换站点图标与分享图?**
直接替换 `assets/img/` 下对应文件即可(favicon.ico、128.png、180.png、jolix.png)。或在后台「favicon.ico 地址」填写自定义图标 URL,该项会覆盖 `<link rel="icon">` 的默认值,但分享图 `og:image` 始终使用主题内置的 `jolix.png`。

**Q: 如何关闭 CDN,使用本地资源?**
后台主题设置将「全站公共库CDN地址」留空即可回退到主题目录下的 `libs/`(主题已内置 AOS、Fancybox、highlight.js、marked,目录结构与 CDN 保持一致)。评论头像预览使用的 md5 库为主题自带的 `assets/js/md5.min.js`,不受该设置影响。

**Q: 如何使用图片宫格?**
正文中手写 `<figure class="pg-4">`(数字对应图片张数,支持 1~9),内部用完整的 `<img>` 标签,可选 `<figcaption>` 作为整组图注:

```html
<figure class="pg-4">
  <img src="a.jpg" alt="">
  <img src="b.jpg" alt="">
  <img src="c.jpg" alt="">
  <img src="d.jpg" alt="">
  <figcaption>图注(可选)</figcaption>
</figure>
```

排列规则:1 图独占整行、2 图各占一半、3 图一行三列、4 图一行四列、5 图上二各半下三各三分之一、6 图两行三列、7 图首图独占一行下两行各三、8 图首行二各半下两行各三、9 图九宫格。同组格子等高,宽格子按更扁的比例裁切(如 5 图的首行按 2:1);移动端 1 图独占一行,2/4/6/8 图各占 50%,3/5/7/9 图首图 100%、其余各占 50%。

> 注意:块级 HTML 内部的 Markdown 语法(`![]()`)不会被解析,图片必须写完整的 `<img>` 标签。

**Q: 缓存数据不更新怎么办?**
删除主题缓存目录(默认 `usr/cache`)下以 `Jolix_` 开头的 `.cache` 文件,或把对应缓存时间改成 `0`。当前会落盘的只有归档 `Jolix_archivesList`、读者墙 `Jolix_readers{条数}`、标签页 `Jolix_tagsList`。侧栏标签云、最新评论、最近文章和友情链接每次请求直接查询。

## 更新日志

详见 [CHANGELOG.md](CHANGELOG.md)。

## 版权

- 主题源码:© [猫东东](https://github.com/xa1st),以 **木兰宽松许可证 第2版 (Mulan PSL v2)** 开源
- 图标库:fontello(字体图标,见 `assets/fonts/fontello.css`)
- 字体:霞鹜文楷屏幕版(LXGW WenKai Screen)
- 前端依赖:AOS / Fancybox / highlight.js / marked,版权归各自作者所有

[木兰宽松许可证 第2版](LICENSE) © 猫东东(Alex Xu)

---

<p align="center">如果喜欢这个主题,欢迎 ⭐ Star 支持一下~</p>
