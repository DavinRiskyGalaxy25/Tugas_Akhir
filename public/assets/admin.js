/**
 * ==============================================================================
 * Admin Panel JavaScript - SMP Al Ahmad Krian
 * Sidebar Mobile/Tablet Handler with Blurred Backdrop & Floating Toast Notifications
 * ==============================================================================
 */

document.addEventListener('DOMContentLoaded', function () {
    initAdminSidebar();
    initFloatingToasts();
});

/**
 * Initialize responsive sidebar & blurred backdrop
 */
function initAdminSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    const backdrop = document.getElementById('adminSidebarBackdrop');
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    const closeBtn = document.getElementById('sidebarCloseBtn');

    if (!sidebar || !backdrop) return;

    function openSidebar() {
        sidebar.classList.add('show');
        backdrop.classList.add('show');
        document.body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('show');
        backdrop.classList.remove('show');
        document.body.classList.remove('sidebar-open');
    }

    // Toggle button in topbar
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (sidebar.classList.contains('show')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    // Close button inside sidebar (mobile/tablet)
    if (closeBtn) {
        closeBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            closeSidebar();
        });
    }

    // Clicking the blurred backdrop closes the sidebar
    backdrop.addEventListener('click', function () {
        closeSidebar();
    });

    // Pressing ESC key closes the sidebar
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && sidebar.classList.contains('show')) {
            closeSidebar();
        }
    });

    // Clicking any sidebar navigation link on small screens closes the sidebar
    const navLinks = sidebar.querySelectorAll('a.nav-link');
    navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 992) {
                closeSidebar();
            }
        });
    });

    // Touch swipe left to close sidebar on mobile
    let touchStartX = 0;
    let touchStartY = 0;

    sidebar.addEventListener('touchstart', function (e) {
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
    }, { passive: true });

    sidebar.addEventListener('touchend', function (e) {
        const touchEndX = e.changedTouches[0].screenX;
        const touchEndY = e.changedTouches[0].screenY;
        const deltaX = touchEndX - touchStartX;
        const deltaY = Math.abs(touchEndY - touchStartY);

        // Horizontal swipe to the left by at least 50px
        if (deltaX < -50 && deltaY < 100) {
            closeSidebar();
        }
    }, { passive: true });
}

/**
 * Initialize and manage floating toast notifications
 */
function initFloatingToasts() {
    const toasts = document.querySelectorAll('.toast-floating');
    toasts.forEach(function (toast) {
        setupToastTimer(toast);
    });
}

function setupToastTimer(toast) {
    const duration = parseInt(toast.getAttribute('data-auto-dismiss'), 10) || 5000;
    const progressBar = toast.querySelector('.toast-progress-bar');

    let startTime = Date.now();
    let remainingTime = duration;
    let timerId = null;
    let isPaused = false;

    if (progressBar) {
        progressBar.style.transition = `width ${duration}ms linear`;
        // Trigger reflow to start transition
        requestAnimationFrame(function () {
            progressBar.style.width = '0%';
        });
    }

    function startTimer() {
        startTime = Date.now();
        timerId = setTimeout(function () {
            closeToast(toast);
        }, remainingTime);
    }

    function pauseTimer() {
        if (isPaused) return;
        isPaused = true;
        clearTimeout(timerId);
        remainingTime -= (Date.now() - startTime);

        if (progressBar) {
            const computedWidth = window.getComputedStyle(progressBar).width;
            progressBar.style.transition = 'none';
            progressBar.style.width = computedWidth;
        }
    }

    function resumeTimer() {
        if (!isPaused || remainingTime <= 0) return;
        isPaused = false;
        if (progressBar) {
            progressBar.style.transition = `width ${remainingTime}ms linear`;
            requestAnimationFrame(function () {
                progressBar.style.width = '0%';
            });
        }
        startTimer();
    }

    // Hover pauses auto-dismiss countdown
    toast.addEventListener('mouseenter', pauseTimer);
    toast.addEventListener('mouseleave', resumeTimer);

    startTimer();
}

/**
 * Dismiss a toast with smooth animation
 */
function closeToast(toastElement) {
    if (!toastElement || toastElement.classList.contains('dismissing')) return;

    toastElement.classList.add('dismissing');

    setTimeout(function () {
        if (toastElement.parentNode) {
            toastElement.parentNode.removeChild(toastElement);
        }
    }, 320);
}

/**
 * Global helper to show dynamic floating toasts from any page / script
 */
window.showFloatingToast = function (type, title, message, duration = 5000) {
    let container = document.getElementById('adminToastContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'adminToastContainer';
        container.className = 'toast-floating-container';
        document.body.appendChild(container);
    }

    const typeIcons = {
        success: 'fa-solid fa-circle-check',
        error: 'fa-solid fa-circle-exclamation',
        warning: 'fa-solid fa-triangle-exclamation',
        info: 'fa-solid fa-circle-info'
    };

    const icon = typeIcons[type] || typeIcons.info;
    const toast = document.createElement('div');
    toast.className = `toast-floating toast-${type}`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('data-auto-dismiss', duration);

    toast.innerHTML = `
        <div class="toast-icon">
            <i class="${icon}"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title">${title}</div>
            <div class="toast-message">${message}</div>
        </div>
        <button type="button" class="toast-close" onclick="closeToast(this.closest('.toast-floating'))" aria-label="Tutup">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="toast-progress">
            <div class="toast-progress-bar" style="width: 100%;"></div>
        </div>
    `;

    container.appendChild(toast);
    setupToastTimer(toast);
};

