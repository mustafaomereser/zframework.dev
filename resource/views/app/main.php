<?php

use zFramework\Core\Csrf;
use zFramework\Core\Facades\Lang;

$lang_list = Lang::list();
?>
<!DOCTYPE html>
<html lang="<?= Lang::$locale ?>" data-theme="<?= @$_COOKIE['theme'] ?>">

<head>
    <meta name="CSRF-X-TOKEN" content="<?= Csrf::get() ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zFramework — <?= _l('main.page-title') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,400;0,500;0,600;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= asset('/assets/libs/notify/style.css') ?>" />
    <link rel="stylesheet" href="<?= asset('/assets/css/style.css') ?>" />
    @yield('header')
</head>

<body>
    <nav class="site-nav">
        <div class="container">
            <div class="nav-inner">

                <!-- Brand -->
                <a href="/" class="nav-brand">
                    <div class="brand-icon"><i class="fas fa-terminal"></i></div>
                    zFramework<span class="brand-cursor"></span>
                    <span class="brand-ver">v2.8.0</span>
                </a>

                <!-- Desktop links -->
                <div class="nav-links">
                    <a href="<?= route('forums.index') ?>" class="nav-link-item active">
                        <i class="fas fa-th-large fa-fw me-1"></i>Forum
                    </a>
                    <a href="https://docs.zframework.dev" class="nav-link-item">
                        <i class="fas fa-book fa-fw me-1"></i><?= _l('main.docs') ?>
                    </a>
                    <a href="https://github.com/mustafaomereser/zFramework" target="_blank" class="nav-link-item">
                        <i class="fab fa-github fa-fw me-1"></i>GitHub
                    </a>
                    <a href="#" class="nav-link-item">
                        <i class="fas fa-code fa-fw me-1"></i><?= _l('main.examples') ?>
                    </a>
                </div>

                <!-- Right -->
                <div class="nav-right">

                    <!-- Desktop search -->
                    <div class="nav-search">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="<?= _l('main.search-placeholder') ?>">
                    </div>

                    <!-- Mobile: open search overlay -->
                    <button class="btn-icon btn-search-mobile" id="searchMobileBtn" title="<?= _l('main.search-mobile-title') ?>">
                        <i class="fas fa-search"></i>
                    </button>

                    <!-- Theme toggle -->
                    <button class="btn-icon" id="themeToggle" title="<?= _l('main.theme-toggle-title') ?>">
                        <i class="fas fa-moon" id="themeIcon"></i>
                    </button>

                    <!-- Notifications -->
                    <div class="nav-notif" id="navNotif">
                        <button class="btn-icon" id="notifBtn" title="<?= _l('main.notifications-title') ?>">
                            <i class="fas fa-bell"></i>
                            <span class="badge-dot" id="notifBadge"></span>
                        </button>
                        <div class="notif-dropdown" id="notifDropdown">
                            <div class="notif-head">
                                <span class="notif-head-title"><?= _l('main.notifications-title') ?></span>
                                <a href="#" class="notif-head-clear" id="notifClearAll"><?= _l('main.mark-all-read') ?></a>
                            </div>
                            <div class="notif-list">
                                <div class="notif-item unread">
                                    <div class="notif-avatar" style="background:rgba(46,107,230,.15);color:var(--accent);">AK</div>
                                    <div class="notif-body">
                                        <div class="notif-text"><strong>ahmet_dev</strong> konunuza cevap verdi</div>
                                        <div class="notif-sub">Route::pre middleware sorusu</div>
                                        <div class="notif-time"><i class="fas fa-clock"></i> 14 dakika önce</div>
                                    </div>
                                    <div class="notif-unread-dot"></div>
                                </div>
                                <div class="notif-item unread">
                                    <div class="notif-avatar" style="background:rgba(15,154,107,.12);color:var(--accent-2);">MO</div>
                                    <div class="notif-body">
                                        <div class="notif-text"><strong>mustafaomereser</strong> konunuzu sabitledi</div>
                                        <div class="notif-sub">zFramework v2.8.0 Sürüm Notları</div>
                                        <div class="notif-time"><i class="fas fa-clock"></i> 1 saat önce</div>
                                    </div>
                                    <div class="notif-unread-dot"></div>
                                </div>
                                <div class="notif-item unread">
                                    <div class="notif-avatar" style="background:rgba(217,119,6,.1);color:var(--accent-3);">EK</div>
                                    <div class="notif-body">
                                        <div class="notif-text"><strong>elif_k</strong> konunuzu beğendi</div>
                                        <div class="notif-sub">softDelete ile join sorunu</div>
                                        <div class="notif-time"><i class="fas fa-clock"></i> 3 saat önce</div>
                                    </div>
                                    <div class="notif-unread-dot"></div>
                                </div>
                                <div class="notif-item">
                                    <div class="notif-avatar" style="background:rgba(139,92,246,.12);color:#8b5cf6;">ST</div>
                                    <div class="notif-body">
                                        <div class="notif-text"><strong>selin_t</strong> konunuza cevap verdi</div>
                                        <div class="notif-sub">@forelse boş dizi davranışı</div>
                                        <div class="notif-time"><i class="fas fa-clock"></i> 1 gün önce</div>
                                    </div>
                                </div>
                                <div class="notif-item">
                                    <div class="notif-avatar" style="background:rgba(46,107,230,.1);color:var(--accent);">BC</div>
                                    <div class="notif-body">
                                        <div class="notif-text"><strong>baran_c</strong> konunuzu çözüldü işaretledi</div>
                                        <div class="notif-sub">Composer kurulumu sonrası hata</div>
                                        <div class="notif-time"><i class="fas fa-clock"></i> 2 gün önce</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="notif-footer"><?= _l('main.see-all-notifications') ?> <i class="fas fa-arrow-right" style="font-size:10px;"></i></a>
                        </div>
                    </div>

                    <div class="nav-lang" id="navLang">
                        <button class="btn-icon nav-lang-btn" type="button" id="langBtn" title="<?= _l('lang.languages') ?>">
                            <i class="fas fa-globe"></i>
                            <span class="nav-lang-label"><?= strtoupper(Lang::currentLocale()) ?></span>
                            <i class="fas fa-chevron-down nav-lang-arrow"></i>
                        </button>
                        <ul class="nav-lang-dropdown" id="langDropdown">
                            <?php foreach ($lang_list as $lang): ?>
                                <li>
                                    <a class="nav-lang-item <?= Lang::currentLocale() == $lang ? 'active' : '' ?>"
                                        href="<?= route('language', ['lang' => $lang]) ?>">
                                        <i class="fas fa-check nav-lang-check"></i>
                                        <?= config("languages.$lang") ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>

                    <?php /*
                    <!-- New post — hidden on mobile -->
                    <a href="#" class="btn-new">
                        <i class="fas fa-plus me-1"></i><?= _l('main.new-thread') ?>
                    </a>
*/ ?>
                    <!-- User dropdown -->
                    <div class="nav-user" id="auth-content"></div>

                    <!-- Hamburger -->
                    <button class="nav-toggle" id="navToggle" title="<?= _l('main.menu-title') ?>">
                        <i class="fas fa-bars"></i>
                    </button>

                </div>
            </div>
        </div>
    </nav>

    <!-- ═══════════════════════════════════════ DRAWER OVERLAY -->
    <div class="drawer-overlay" id="drawerOverlay"></div>

    <!-- ═══════════════════════════════════════ MOBILE DRAWER -->
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-head">
            <div class="drawer-brand">
                <div class="brand-icon" style="width:24px;height:24px;background:var(--accent);border-radius:5px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:11px;">
                    <i class="fas fa-terminal"></i>
                </div>
                zFramework
            </div>
            <button class="drawer-close" id="drawerClose"><i class="fas fa-times"></i></button>
        </div>

        <!-- Search -->
        <div class="drawer-search">
            <div class="drawer-search-wrap">
                <i class="fas fa-search si"></i>
                <input type="text" placeholder="<?= _l('main.search-placeholder-drawer') ?>">
            </div>
        </div>

        <!-- Nav links -->
        <div class="drawer-section-label"><?= _l('main.nav-navigation') ?></div>
        <a href="#" class="drawer-link active">
            <span class="dl-icon"><i class="fas fa-th-large"></i></span>Forum
        </a>
        <a href="https://docs.zframework.dev" class="drawer-link">
            <span class="dl-icon"><i class="fas fa-book"></i></span><?= _l('main.docs') ?>
        </a>
        <a href="https://github.com/mustafaomereser/zFramework" target="_blank" class="drawer-link">
            <span class="dl-icon"><i class="fab fa-github"></i></span>GitHub
        </a>
        <a href="#" class="drawer-link">
            <span class="dl-icon"><i class="fas fa-code"></i></span><?= _l('main.examples') ?>
        </a>

        <!-- Forum links -->
        <div class="drawer-section-label" style="margin-top:4px;">Forum</div>
        <a href="#" class="drawer-link">
            <span class="dl-icon"><i class="fas fa-clock"></i></span><?= _l('main.recent-threads') ?>
        </a>
        <a href="#" class="drawer-link">
            <span class="dl-icon"><i class="fas fa-fire"></i></span><?= _l('main.popular') ?>
        </a>
        <a href="#" class="drawer-link">
            <span class="dl-icon"><i class="fas fa-question-circle"></i></span><?= _l('main.unsolved') ?>
        </a>
        <a href="#" class="drawer-link">
            <span class="dl-icon"><i class="fas fa-bullhorn"></i></span><?= _l('main.announcements') ?>
        </a>

        <!-- Theme toggle -->
        <div class="drawer-section-label" style="margin-top:4px;"><?= _l('main.appearance') ?></div>
        <div class="drawer-link" id="drawerThemeToggle" style="cursor:pointer;">
            <span class="dl-icon"><i class="fas fa-moon" id="drawerThemeIcon"></i></span>
            <span id="drawerThemeLabel"><?= _l('main.dark-theme') ?></span>
        </div>

        <!-- New post -->
        <div style="padding:12px 16px 4px;">
            <a href="#" class="btn-new" style="display:flex;align-items:center;justify-content:center;gap:6px;padding:9px 14px;border-radius:8px;animation:none;box-shadow:none;">
                <i class="fas fa-plus"></i><?= _l('main.new-thread-open') ?>
            </a>
        </div>

        <!-- User section -->
        <div class="drawer-user">
            <div class="drawer-user-info">
                <div class="drawer-avatar">MO</div>
                <div>
                    <div class="drawer-user-name">mustafaomereser</div>
                    <div class="drawer-user-role"><?= _l('main.role-developer') ?></div>
                </div>
            </div>
            <a href="#" class="drawer-link" style="padding-left:0;border-radius:6px;">
                <span class="dl-icon"><i class="fas fa-user"></i></span><?= _l('main.my-profile') ?>
            </a>
            <a href="#" class="drawer-link" style="padding-left:0;border-radius:6px;">
                <span class="dl-icon"><i class="fas fa-cog"></i></span><?= _l('main.settings') ?>
            </a>
            <a href="#" class="drawer-link" style="padding-left:0;border-radius:6px;color:var(--danger);">
                <span class="dl-icon" style="color:var(--danger);"><i class="fas fa-sign-out-alt"></i></span><?= _l('lang.signout') ?>
            </a>
        </div>
    </div>

    <div class="search-overlay" id="searchOverlay">
        <div class="search-overlay-box">
            <i class="fas fa-search" style="color:var(--txt-muted);font-size:14px;flex-shrink:0;"></i>
            <input type="text" id="searchOverlayInput" placeholder="<?= _l('main.search-placeholder-overlay') ?>">
            <button class="search-overlay-close" id="searchOverlayClose"><i class="fas fa-times"></i></button>
        </div>
    </div>

    <div class="page-header">
        <div class="container">
            <h1 class="page-title"><?= _l('main.page-title') ?></h1>
            <p class="page-subtitle"><?= _l('main.page-subtitle') ?></p>
            <div class="header-tabs"></div>
        </div>
    </div>

    <div class="forum-layout">
        @yield('body')
    </div>

    <footer class="site-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="footer-brand"><i class="fas fa-terminal me-1 text-accent"></i> zFramework</span>
                    <span style="margin-left:10px;">v2.8.0 &mdash; PHP MVC Framework</span>
                </div>
                <div class="col-md-6 text-md-end mt-2 mt-md-0" style="display:flex;gap:16px;justify-content:flex-end;flex-wrap:wrap;">
                    <a href="https://docs.zframework.dev"><?= _l('main.documentation') ?></a>
                    <a href="https://github.com/mustafaomereser/zFramework" target="_blank">GitHub</a>
                    <a href="#"><?= _l('main.forum-rules') ?></a>
                </div>
            </div>
        </div>
    </footer>

    <div id="load-modals"></div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('/assets/js/main.js') ?>"></script>
    <script src="<?= asset('/assets/js/forum.js') ?>"></script>
    <script src="<?= asset('/assets/libs/notify/script.js') ?>"></script>

    <script>
        const html = document.documentElement;
        const toggleBtn = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const drawerThemeToggle = document.getElementById('drawerThemeToggle');
        const drawerThemeIcon = document.getElementById('drawerThemeIcon');
        const drawerThemeLabel = document.getElementById('drawerThemeLabel');

        function getSystemTheme() {
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        function applyTheme(theme) {
            html.setAttribute('data-theme', theme);
            const isDark = theme === 'dark';
            themeIcon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
            toggleBtn.title = isDark ? '<?= _l('main.switch-to-light') ?>' : '<?= _l('main.switch-to-dark') ?>';
            drawerThemeIcon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
            drawerThemeLabel.textContent = isDark ? '<?= _l('main.light-theme') ?>' : '<?= _l('main.dark-theme') ?>';
            localStorage.setItem('zf-theme', theme);
        }

        const savedTheme = localStorage.getItem('zf-theme');
        applyTheme(savedTheme || getSystemTheme());

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (!localStorage.getItem('zf-theme')) applyTheme(e.matches ? 'dark' : 'light');
        });

        const toggleTheme = () => applyTheme(html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        toggleBtn.addEventListener('click', toggleTheme);
        drawerThemeToggle.addEventListener('click', toggleTheme);

        /* ═══════════════════════════════════════
           MOBILE DRAWER
        ═══════════════════════════════════════ */
        const drawer = document.getElementById('mobileDrawer');
        const drawerOverlay = document.getElementById('drawerOverlay');
        const navToggle = document.getElementById('navToggle');
        const drawerClose = document.getElementById('drawerClose');

        function openDrawer() {
            drawer.classList.add('open');
            drawerOverlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer() {
            drawer.classList.remove('open');
            drawerOverlay.classList.remove('open');
            document.body.style.overflow = '';
        }

        navToggle.addEventListener('click', openDrawer);
        drawerClose.addEventListener('click', closeDrawer);
        drawerOverlay.addEventListener('click', closeDrawer);

        // Close drawer on escape
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                closeDrawer();
                closeSearchOverlay();
                closeDropdown();
                closeNotif();
            }
        });

        /* ═══════════════════════════════════════
           NOTIFICATION DROPDOWN
        ═══════════════════════════════════════ */
        const navNotif = document.getElementById('navNotif');
        const notifBtn = document.getElementById('notifBtn');
        const notifDropdown = document.getElementById('notifDropdown');
        const notifBadge = document.getElementById('notifBadge');
        const notifClearAll = document.getElementById('notifClearAll');

        let unreadCount = document.querySelectorAll('.notif-item.unread').length;

        function updateBadge() {
            notifBadge.style.display = unreadCount > 0 ? 'block' : 'none';
        }
        updateBadge();

        function openNotif() {
            navNotif.classList.add('open');
            closeDropdown();
        }

        function closeNotif() {
            navNotif.classList.remove('open');
        }

        function toggleNotif() {
            navNotif.classList.toggle('open');
            if (navNotif.classList.contains('open')) closeDropdown();
        }

        notifBtn.addEventListener('click', e => {
            e.stopPropagation();
            toggleNotif();
        });
        document.addEventListener('click', e => {
            if (!navNotif.contains(e.target)) closeNotif();
        });

        // Mark read on click
        document.querySelectorAll('.notif-item').forEach(item => {
            item.addEventListener('click', () => {
                if (item.classList.contains('unread')) {
                    item.classList.remove('unread');
                    const dot = item.querySelector('.notif-unread-dot');
                    if (dot) dot.remove();
                    unreadCount = Math.max(0, unreadCount - 1);
                    updateBadge();
                }
            });
        });

        // Clear all
        notifClearAll.addEventListener('click', e => {
            e.preventDefault();
            document.querySelectorAll('.notif-item.unread').forEach(item => {
                item.classList.remove('unread');
                const dot = item.querySelector('.notif-unread-dot');
                if (dot) dot.remove();
            });
            unreadCount = 0;
            updateBadge();
        });

        /* ═══════════════════════════════════════
           SEARCH OVERLAY (mobile)
        ═══════════════════════════════════════ */
        const searchOverlay = document.getElementById('searchOverlay');
        const searchMobileBtn = document.getElementById('searchMobileBtn');
        const searchOverlayClose = document.getElementById('searchOverlayClose');
        const searchOverlayInput = document.getElementById('searchOverlayInput');

        function openSearchOverlay() {
            searchOverlay.classList.add('open');
            document.body.style.overflow = 'hidden';
            setTimeout(() => searchOverlayInput.focus(), 120);
        }

        function closeSearchOverlay() {
            searchOverlay.classList.remove('open');
            document.body.style.overflow = '';
        }

        searchMobileBtn.addEventListener('click', openSearchOverlay);
        searchOverlayClose.addEventListener('click', closeSearchOverlay);
        searchOverlay.addEventListener('click', e => {
            if (e.target === searchOverlay) closeSearchOverlay();
        });

        /* ═══════════════════════════════════════
           SCROLL-TRIGGERED ANIMATIONS (IntersectionObserver)
        ═══════════════════════════════════════ */
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.08,
        });

        document.querySelectorAll('.animate-entry').forEach(el => observer.observe(el));

        /* ═══════════════════════════════════════
           NAVBAR SCROLL SHADOW
        ═══════════════════════════════════════ */
        const nav = document.querySelector('.site-nav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 8);
        }, {
            passive: true
        });

        /* ═══════════════════════════════════════
           RIPPLE EFFECT
        ═══════════════════════════════════════ */
        document.querySelectorAll('.btn-new').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const wave = document.createElement('span');
                wave.className = 'ripple-wave';
                wave.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;`;
                this.appendChild(wave);
                setTimeout(() => wave.remove(), 600);
            });
        });

        /* ═══════════════════════════════════════
           COUNTER ANIMATION
        ═══════════════════════════════════════ */
        function parseVal(str) {
            str = str.trim();
            if (str.endsWith('k')) return parseFloat(str) * 1000;
            return parseFloat(str);
        }

        function formatVal(num, original) {
            if (original.endsWith('k')) return (num / 1000).toFixed(1) + 'k';
            return Math.round(num).toString();
        }

        function animateCounter(el) {
            const original = el.textContent.trim();
            const target = parseVal(original);
            if (isNaN(target)) return;
            const duration = 900;
            const start = performance.now();

            function tick(now) {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                el.textContent = formatVal(target * eased, original);
                if (progress < 1) requestAnimationFrame(tick);
                else el.textContent = original;
            }
            requestAnimationFrame(tick);
        }
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });
        document.querySelectorAll('.stat-val, .st-val, .num').forEach(el => counterObserver.observe(el));

        /* ═══════════════════════════════════════
           INTERACTIVE TABS
        ═══════════════════════════════════════ */
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                this.closest('.filter-tabs').querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
        document.querySelectorAll('.header-tab').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                this.closest('.header-tabs').querySelectorAll('.header-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
        document.querySelectorAll('.cat-nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.cat-nav-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        /* ═══════════════════════════════════════
           CARD PRESS FEEDBACK
        ═══════════════════════════════════════ */
        document.querySelectorAll('.thread-card, .forum-row').forEach(card => {
            card.addEventListener('mousedown', function() {
                this.style.transform = 'scale(0.995)';
            });
            card.addEventListener('mouseup', function() {
                this.style.transform = '';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });

        /* ═══════════════════════════════════════
           NOTICE BANNER SMOOTH CLOSE
        ═══════════════════════════════════════ */
        document.querySelectorAll('.notice-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const banner = this.closest('.notice-banner');
                banner.style.transition = 'opacity .25s, max-height .35s, margin .35s, padding .35s';
                banner.style.overflow = 'hidden';
                banner.style.opacity = '0';
                banner.style.maxHeight = banner.offsetHeight + 'px';
                requestAnimationFrame(() => {
                    banner.style.maxHeight = '0';
                    banner.style.marginBottom = '0';
                    banner.style.padding = '0';
                });
                setTimeout(() => banner.remove(), 380);
            });
        });

        /* Initial viewport reveal */
        document.querySelectorAll('.animate-entry').forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight) el.classList.add('visible');
        });

        // ── Language Switcher ──
        // Diğer dropdown'larla aynı pattern — open/close/escape/dışarı tıklama

        const navLang = document.getElementById('navLang');
        const langBtn = document.getElementById('langBtn');
        const langDropdown = document.getElementById('langDropdown');

        function openLang() {
            navLang.classList.add('open');
        }

        function closeLang() {
            navLang.classList.remove('open');
        }

        function toggleLang() {
            navLang.classList.toggle('open');
        }

        langBtn.addEventListener('click', e => {
            e.stopPropagation();
            toggleLang();
            // Diğer açık dropdown'ları kapat
            closeDropdown?.();
            closeNotif?.();
        });

        document.addEventListener('click', e => {
            if (!navLang.contains(e.target)) closeLang();
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeLang();
        });
    </script>


    <script>
        $.showAlerts(<?= json_encode(\zFramework\Core\Facades\Alerts::get()) ?>);
    </script>
    @yield('footer')
</body>

</html>