/**
 * 图片懒加载和灯箱功能管理类
 * 适用于全站所有需要懒加载图片的页面
 */
class LazyLoadManager {
    /**
    * 构造函数
    * @param {Object} options - 配置选项
    */
    constructor(options = {}) {
        this.options = {
            selector: ".post-content img[data-src], .says-gallery img[data-src]",
            rootMargin: "100px",
            ...options,
        };
        this.imageObserver = new IntersectionObserver(
            this.onIntersection.bind(this), { rootMargin: this.options.rootMargin }
        );
    }
  
    /**
    * 交叉观察回调
    */
    onIntersection(entries, observer) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.classList.contains("loaded")) return;
                const newImg = new Image();
                newImg.onload = () => {
                    img.src = newImg.src;
                    img.classList.add("loaded");
                    this.initializeFancybox();
                };
                newImg.onerror = () => {
                    img.style.background = "#f0f0f0";
                    img.style.animation = "none";
                    img.style.opacity = "0.5";
                    img.setAttribute("alt", "加载失败");
                  
                    const errorText = document.createElement("div");
                    errorText.textContent = "×";
                    errorText.style.cssText = `position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:24px;color:#999;pointer-events:none;`;
                    const container = img.parentNode;
                    if (container.style.position !== "relative") container.style.position = "relative";
                    container.appendChild(errorText);
                };
                newImg.src = img.dataset.src;
                observer.unobserve(img);
            }
        });
    }
  
    /**
    * 处理图片，将其转换为懒加载模式
    * @param {string} containerSelector - 图片容器选择器
    */
    processImages(containerSelector = ".post-content, .says-gallery") {
        const containers = document.querySelectorAll(containerSelector);
        containers.forEach(container => {
            const images = container.querySelectorAll('img:not([data-processed])');
            images.forEach(img => {
                if (!img.dataset.processed) {
                    if (img.src && !img.dataset.src) {
                        img.dataset.src = img.src;
                        img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7";
                    }
                    img.dataset.processed = 'true';
                    this.imageObserver.observe(img);
                }
            });
        });
    }
  
    /**
    * 初始化Fancybox
    */
    initializeFancybox() {
        // CDN 回退时脚本可能晚于首次图片加载完成,轮询等待其就绪
        if (!window.Fancybox) {
            this._fbRetries = (this._fbRetries || 0) + 1;
            if (this._fbRetries <= 20) setTimeout(() => this.initializeFancybox(), 500);
            return;
        }
        window.Fancybox.destroy();
        document.querySelectorAll('.post-content p:has(img:not(.emoji)), .says-gallery p:has(img:not(.emoji)), .post-content figure[class*="pg-"]').forEach((paragraph, groupIndex) => {
            const images = paragraph.querySelectorAll('img.loaded:not(.emoji)');
            if (images.length === 0) return;
            images.forEach((img, imgIndex) => {
                img.setAttribute('data-fancybox', `gallery-${groupIndex}`);
                img.setAttribute('data-src', img.src || img.dataset.src);
                img.setAttribute('data-caption', img.alt || `图片 ${imgIndex + 1}`);
            });
        });
        window.Fancybox.bind('[data-fancybox]', {
            UI: {toolbar: {display: {left: ['infobar'], middle: [], right: ['close']}}},
            Images: {protect: false, preload: 1},
            animated: true,
            showClass: "f-fadeIn",
            hideClass: "f-fadeOut",
            touch: {vertical: true, momentum: true},
            keyboard: {Escape: "close", Delete: "close", Backspace: "close", PageUp: "prev", PageDown: "next", ArrowUp: "prev", ArrowDown: "next", ArrowRight: "next", ArrowLeft: "prev"},
            dragToClose: true,
            backdropClick: "close",
            l10n: {CLOSE: "关闭", NEXT: "下一张", PREV: "上一张", MODAL: "您可以使用键盘导航", ERROR: "加载失败", ZOOM_IN: "放大", ZOOM_OUT: "缩小",TOGGLE_ZOOM: "切换缩放", TOGGLE_FULLSCREEN: "切换全屏"}
        });
    }
  
    /**
    * 初始化懒加载
    */
    init() {
        this.processImages();
        this.initializeFancybox();
    }
}
// 全部dom加载完时运行
document.addEventListener('DOMContentLoaded', () =>{
    // 初始化AOS动画组件(脚本缺失时不阻断后续初始化)
    if (typeof AOS !== 'undefined') AOS.init({ duration: 800, once: true });
    // 初始化懒加载和灯箱功能(挂到 window,供 says.js 等动态渲染的内容复用)
    window.lazyLoadManager = new LazyLoadManager();
    window.lazyLoadManager.init();
    // 初始化代码高亮
    if (typeof hljs !== 'undefined') {
        hljs.highlightAll();
        // 根据当前主题设置代码高亮样式
        const updateHighlightTheme = () => {
            const isDark = document.documentElement.className.includes('dark');
            document.getElementById('hljs-light').disabled = isDark;
            document.getElementById('hljs-dark').disabled = !isDark;
        };
        updateHighlightTheme();
        // 为所有代码块添加复制按钮
        document.querySelectorAll('pre code').forEach(block => {
            const btn = document.createElement('button');
            btn.className = 'code-copy-btn';
            btn.textContent = '复制';
            btn.onclick = () => {
                navigator.clipboard.writeText(block.textContent).then(() => {
                    btn.textContent = '已复制';
                    setTimeout(() => btn.textContent = '复制', 2000);
                });
            };
            block.parentElement.appendChild(btn);
        });
    }
    // 定义浮动功能条
    const tooltip = document.getElementById("tooltip");
    // 监听滚动事件
    window.addEventListener("scroll", () => {
        if (window.scrollY > 100) {
            tooltip.classList.add("opacity-100");
            tooltip.classList.remove("opacity-0", "pointer-events-none");
        } else {
            tooltip.classList.remove("opacity-100");
            tooltip.classList.add("opacity-0", "pointer-events-none")
        }
    });
    // 功能条 - 回到顶部
    const backToTop = document.getElementById("back-to-top");
    // 如果不存则，则不绑定事件
    if (backToTop) {
        document.getElementById("back-to-top").addEventListener("click", () => {
            // 常量
            const startTime = Date.now(), startY = window.scrollY;
            // 动画定义
            let animate = () => { 
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / 300, 1);
                window.scrollTo(0, startY * (1 - progress * (2 - progress)));
                elapsed < 300 ? requestAnimationFrame(animate) : window.scrollTo(0, 0); // 确保归零
                return;
            };
            // 调用
            requestAnimationFrame(animate);
        });
    }
    // 移动端搜索框
    const mobileSearch = document.getElementById("mobile-search");
    // 只有在有移动端搜索框时才执行
    if (mobileSearch) {
        // 功能条 - 搜索
        const searchBtn = document.getElementById("search-btn");
        // 关闭按钮
        const closeSearch = document.getElementById("close-search");
        // 弹出搜索框 
        if (searchBtn) searchBtn.addEventListener("click", () => mobileSearch.classList.remove("hidden"));
        // 关闭搜索框 
        if (closeSearch) closeSearch.addEventListener("click", () => mobileSearch.classList.add("hidden"));
        // 遮罩层关闭事件
        mobileSearch.addEventListener('click', e => e.target === mobileSearch && mobileSearch.classList.add('hidden'));
    }
    
    // 主题切换
    const themeToggles = document.querySelectorAll(".themeToggle");
    // 定义主题循环顺序及其配置
    const themeConfig = {light: "dark", dark: "auto", auto: "light"};
    themeToggles.forEach(toggle => toggle.addEventListener("click", () => {
        // 获取当前主题，如果未设置，则默认为"auto"
        const currentTheme = localStorage.getItem("theme") || "auto";
        // 如果当前是dark，那么下一个就是auto
        const nextTheme = currentTheme === "dark" ? (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark auto" : "light auto") : themeConfig[currentTheme];
        // 应用新主题
        document.documentElement.className = nextTheme;
        // 保存到localStorage
        localStorage.setItem("theme", currentTheme === "dark" ? "auto" : nextTheme);
        // 切换代码高亮主题
        if (typeof hljs !== 'undefined') {
            const isDark = nextTheme.includes('dark');
            document.getElementById('hljs-light').disabled = isDark;
            document.getElementById('hljs-dark').disabled = !isDark;
        }
    }));

    // 建站日期对象
    const timeElement = document.getElementById("build-years");
    // 最后计算的时间
    let timeDate = "";
    // 如果没有拿出值
    if (timeElement) {
        // 获取建站时间
        const startDate = new Date(timeElement.getAttribute("data-time"));
        // 如果不存在则不执行
        if (startDate && !isNaN(startDate.getTime())) {
            // 当前时间
            const currentDate = new Date();
            // 计算总天数
            const totalDays = Math.floor((currentDate.getTime() - startDate.getTime()) / (1000 * 60 * 60 * 24));
            // 计算年份和剩余天数
            const years = Math.floor(totalDays / 365), remainingDays = totalDays % 365;
            // 构建显示文本
            if (years > 0) timeDate += `${years}年`;
            // if (years > 0 && remainingDays > 0) timeDate += '又';
            if (remainingDays > 0) timeDate += `${remainingDays}天`;
        }
        timeElement.innerHTML = timeDate || "有些日子了";
    }
});