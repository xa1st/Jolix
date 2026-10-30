// 全部dom加载完时运行
document.addEventListener('DOMContentLoaded', () =>{
    // 初始化AOS动画组件
    AOS.init({ duration: 800, once: true });
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
    }
    timeElement.innerHTML = timeDate || "有些日子了";
    // 初始化懒加载
    window.lazyLoadManager.init();
});