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
            selector: ".post-content img[data-src], .says-content img[data-src]",
            rootMargin: "100px",
            ...options
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
    processImages(containerSelector = ".post-content, .says-content") {
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
        if (!window.Fancybox) return;
        window.Fancybox.destroy();
        document.querySelectorAll('.post-content p:has(img)').forEach((paragraph, groupIndex) => {
            const images = paragraph.querySelectorAll('img.loaded');
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
// 创建全局实例
window.lazyLoadManager = new LazyLoadManager();
