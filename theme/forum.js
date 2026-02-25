/* ═══════════════════════════════════════════════════════
   zForum — Main JavaScript
   jQuery + Bootstrap 5.3
═══════════════════════════════════════════════════════ */

const zForum = (() => {

  /* ─────────────────────────────────────────
     CONFIG — API base URL buraya
  ───────────────────────────────────────── */
  const API = {
    base:          '/api',
    categories:    '/api/categories',
    topics:        '/api/topics',
    topic:         (id) => `/api/topics/${id}`,
    posts:         (id) => `/api/topics/${id}/posts`,
    reply:         (id) => `/api/topics/${id}/posts`,
    likePost:      (id) => `/api/posts/${id}/like`,
    notifications: '/api/notifications',
    notifRead:     (id) => `/api/notifications/${id}/read`,
    notifReadAll:  '/api/notifications/read-all',
    profile:       (u)  => `/api/users/${u}`,
    signin:        '/api/auth/signin',
    signup:        '/api/auth/signup',
    signout:       '/api/auth/signout',
    search:        '/api/search',
  };

  /* ─────────────────────────────────────────
     HELPERS
  ───────────────────────────────────────── */
  const request = (method, url, data = null) =>
    $.ajax({
      url,
      method,
      data: data ? JSON.stringify(data) : null,
      contentType: 'application/json',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    });

  const get  = (url)        => request('GET', url);
  const post = (url, data)  => request('POST', url, data);
  const put  = (url, data)  => request('PUT', url, data);
  const del  = (url)        => request('DELETE', url);

  /* ─────────────────────────────────────────
     TOAST
  ───────────────────────────────────────── */
  const toast = (() => {
    let wrap = null;

    function getWrap() {
      if (!wrap) {
        wrap = $('<div id="zf-toast-wrap"></div>').css({
          position: 'fixed', bottom: '24px', right: '24px',
          zIndex: 9999, display: 'flex', flexDirection: 'column', gap: '8px',
        }).appendTo('body');
      }
      return wrap;
    }

    return {
      show(msg, type = 'info', duration = 3500) {
        const icons = { success: 'fa-check-circle', error: 'fa-exclamation-circle', info: 'fa-info-circle', warn: 'fa-exclamation-triangle' };
        const colors = { success: 'var(--accent-2)', error: 'var(--danger)', info: 'var(--accent)', warn: 'var(--accent-3)' };
        const t = $(`
          <div style="
            background:var(--bg-card);border:1px solid var(--border);
            border-left:3px solid ${colors[type]};border-radius:8px;
            padding:10px 14px;display:flex;align-items:center;gap:10px;
            box-shadow:var(--shadow-md);font-size:13px;color:var(--txt);
            min-width:240px;max-width:320px;
            animation:fadeUp .25s ease both;
          ">
            <i class="fas ${icons[type]}" style="color:${colors[type]};font-size:14px;flex-shrink:0;"></i>
            <span>${msg}</span>
          </div>
        `).appendTo(getWrap());
        setTimeout(() => t.css({ opacity: 0, transition: 'opacity .3s' }), duration);
        setTimeout(() => t.remove(), duration + 350);
      },
      success: (msg) => toast.show(msg, 'success'),
      error:   (msg) => toast.show(msg, 'error'),
      warn:    (msg) => toast.show(msg, 'warn'),
    };
  })();

  /* ─────────────────────────────────────────
     THEME
  ───────────────────────────────────────── */
  const theme = (() => {
    const html = document.documentElement;

    function apply(t) {
      html.setAttribute('data-theme', t);
      const dark = t === 'dark';
      $('#themeIcon').attr('class', dark ? 'fas fa-sun' : 'fas fa-moon');
      $('#drawerThemeIcon').attr('class', dark ? 'fas fa-sun' : 'fas fa-moon');
      $('#drawerThemeLabel').text(dark ? 'Aydınlık Tema' : 'Karanlık Tema');
      localStorage.setItem('zf-theme', t);
    }

    function init() {
      const saved = localStorage.getItem('zf-theme');
      const sys   = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
      apply(saved || sys);
      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('zf-theme')) apply(e.matches ? 'dark' : 'light');
      });
      const toggle = () => apply(html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
      $('#themeToggle, #drawerThemeToggle').on('click', toggle);
    }

    return { init };
  })();

  /* ─────────────────────────────────────────
     NAVBAR
  ───────────────────────────────────────── */
  const navbar = (() => {
    function init() {
      // Scroll shadow
      $(window).on('scroll.nav', () => {
        $('.site-nav').toggleClass('scrolled', window.scrollY > 8);
      });

      // Ripple on .btn-new
      $(document).on('click', '.btn-new', function(e) {
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        $('<span class="ripple-wave"></span>').css({
          width: size, height: size,
          left: e.clientX - rect.left - size / 2,
          top:  e.clientY - rect.top  - size / 2,
        }).appendTo(this);
        setTimeout(() => $(this).find('.ripple-wave').remove(), 600);
      });

      // Card press
      $(document).on('mousedown', '.thread-card, .forum-row', function() {
        $(this).css('transform', 'scale(0.995)');
      }).on('mouseup mouseleave', '.thread-card, .forum-row', function() {
        $(this).css('transform', '');
      });
    }

    return { init };
  })();

  /* ─────────────────────────────────────────
     DRAWER
  ───────────────────────────────────────── */
  const drawer = (() => {
    function open() {
      $('#mobileDrawer, #drawerOverlay').addClass('open');
      $('body').css('overflow', 'hidden');
    }
    function close() {
      $('#mobileDrawer, #drawerOverlay').removeClass('open');
      $('body').css('overflow', '');
    }
    function init() {
      $('#navToggle').on('click', open);
      $('#drawerClose, #drawerOverlay').on('click', close);
    }
    return { init, close };
  })();

  /* ─────────────────────────────────────────
     DROPDOWNS (user, notif, lang)
     Hepsi aynı pattern — open/close/toggle
  ───────────────────────────────────────── */
  const dropdowns = (() => {
    const map = {
      user:  { wrap: '#navUser',  btn: '#navAvatarBtn'  },
      notif: { wrap: '#navNotif', btn: '#notifBtn'      },
      lang:  { wrap: '#navLang',  btn: '#langBtn'       },
    };

    function closeAll(except) {
      Object.entries(map).forEach(([k, v]) => {
        if (k !== except) $(v.wrap).removeClass('open');
      });
    }

    function init() {
      Object.entries(map).forEach(([key, { wrap, btn }]) => {
        $(document).on('click', btn, e => {
          e.stopPropagation();
          const isOpen = $(wrap).hasClass('open');
          closeAll(key);
          $(wrap).toggleClass('open', !isOpen);
          drawer.close();
        });
      });

      $(document).on('click', e => {
        if (!$(e.target).closest(Object.values(map).map(v => v.wrap).join(',')).length) {
          closeAll();
        }
      });
    }

    return { init, closeAll };
  })();

  /* ─────────────────────────────────────────
     SEARCH OVERLAY
  ───────────────────────────────────────── */
  const searchOverlay = (() => {
    function open() {
      $('#searchOverlay').addClass('open');
      $('body').css('overflow', 'hidden');
      setTimeout(() => $('#searchOverlayInput').focus(), 120);
    }
    function close() {
      $('#searchOverlay').removeClass('open');
      $('body').css('overflow', '');
    }
    function init() {
      $('#searchMobileBtn').on('click', open);
      $('#searchOverlayClose').on('click', close);
      $('#searchOverlay').on('click', function(e) {
        if ($(e.target).is('#searchOverlay')) close();
      });

      // Live search
      let timer;
      $('#searchOverlayInput').on('input', function() {
        clearTimeout(timer);
        const q = $(this).val().trim();
        if (q.length < 2) return;
        timer = setTimeout(() => {
          get(`${API.search}?q=${encodeURIComponent(q)}`).then(res => {
            // Sonuçları render et — backend'e göre uyarlanır
          });
        }, 350);
      });
    }
    return { init, close };
  })();

  /* ─────────────────────────────────────────
     NOTIFICATIONS
  ───────────────────────────────────────── */
  const notifications = (() => {
    let unread = 0;

    function updateBadge() {
      $('#notifBadge').toggle(unread > 0);
    }

    function markRead(id, $item) {
      if (!$item.hasClass('unread')) return;
      $item.removeClass('unread');
      $item.find('.notif-unread-dot').remove();
      unread = Math.max(0, unread - 1);
      updateBadge();
      if (id) put(API.notifRead(id));
    }

    function markAllRead() {
      $('.notif-item.unread').each(function() {
        $(this).removeClass('unread').find('.notif-unread-dot').remove();
      });
      unread = 0;
      updateBadge();
      put(API.notifReadAll);
    }

    function load() {
      get(API.notifications).then(res => {
        unread = res.unread_count || 0;
        updateBadge();
        // render edilebilir — şimdilik statik HTML var
      }).catch(() => {});
    }

    function init() {
      unread = $('.notif-item.unread').length;
      updateBadge();

      $(document).on('click', '.notif-item', function() {
        markRead($(this).data('id'), $(this));
      });

      $(document).on('click', '#notifClearAll', e => {
        e.preventDefault();
        markAllRead();
      });

      // Her 60 saniyede yenile
      setInterval(load, 60000);
    }

    return { init, load };
  })();

  /* ─────────────────────────────────────────
     AUTH MODAL
  ───────────────────────────────────────── */
  const auth = (() => {
    function open(tab = 'signin') {
      $('#authOverlay').addClass('open');
      $('body').css('overflow', 'hidden');
      switchTab(tab);
      clearAlert();
      dropdowns.closeAll();
    }

    function close() {
      $('#authOverlay').removeClass('open');
      $('body').css('overflow', '');
    }

    function switchTab(tab) {
      $('.auth-tab-btn').removeClass('active');
      $('.auth-pane').removeClass('active');
      $(`.auth-tab-btn[data-tab="${tab}"]`).addClass('active');
      $(`#pane-${tab}`).addClass('active');
      clearAlert();
    }

    function showAlert(msg, type = 'error') {
      $('#authAlert').attr('class', `auth-alert-strip show ${type}`).find('#authAlertMsg').text(msg);
    }

    function clearAlert() {
      $('#authAlert').attr('class', 'auth-alert-strip');
    }

    function setLoading($btn, state) {
      $btn.toggleClass('loading', state).prop('disabled', state);
    }

    function init() {
      // Open triggers
      $(document).on('click', '[data-auth]', function(e) {
        e.preventDefault();
        open($(this).data('auth') || 'signin');
      });

      // Close
      $('#authModalClose').on('click', close);
      $('#authOverlay').on('click', function(e) {
        if ($(e.target).is('#authOverlay')) close();
      });

      // Tabs
      $(document).on('click', '.auth-tab-btn', function() {
        switchTab($(this).data('tab'));
      });

      // Password toggle
      $(document).on('click', '.pw-toggle', function(e) {
        e.preventDefault();
        const $input = $('#' + $(this).data('target'));
        const $icon  = $(this).find('i');
        const hidden = $input.attr('type') === 'password';
        $input.attr('type', hidden ? 'text' : 'password');
        $icon.toggleClass('fa-eye', !hidden).toggleClass('fa-eye-slash', hidden);
      });

      // Sign in
      $('#signinForm').on('submit', function(e) {
        e.preventDefault();
        const $btn = $('#signinBtn');
        clearAlert();
        setLoading($btn, true);
        post(API.signin, {
          email:         $(this).find('[name="email"]').val(),
          password:      $(this).find('[name="password"]').val(),
          keep_logged_in: $(this).find('[name="keep-logged-in"]').is(':checked'),
        }).then(res => {
          close();
          toast.success('Hoş geldiniz!');
          setTimeout(() => location.reload(), 800);
        }).catch(err => {
          setLoading($btn, false);
          showAlert(err.responseJSON?.message || 'E-posta veya şifre hatalı.');
        });
      });

      // Sign up
      $('#signupForm').on('submit', function(e) {
        e.preventDefault();
        const $btn = $('#signupBtn');
        const pw   = $(this).find('[name="password"]').val();
        const pw2  = $(this).find('[name="re-password"]').val();
        clearAlert();
        if (pw !== pw2)               return showAlert('Şifreler eşleşmiyor.');
        if (!$(this).find('[name="terms"]').is(':checked')) return showAlert('Kullanım koşullarını kabul etmelisiniz.');
        setLoading($btn, true);
        post(API.signup, {
          username:   $(this).find('[name="username"]').val(),
          email:      $(this).find('[name="email"]').val(),
          password:   pw,
        }).then(() => {
          showAlert('Kayıt başarılı! Giriş yapabilirsiniz.', 'success');
          setTimeout(() => switchTab('signin'), 1500);
        }).catch(err => {
          setLoading($btn, false);
          showAlert(err.responseJSON?.message || 'Kayıt başarısız.');
        });
      });

      // Sign out
      $(document).on('click', '#signoutBtn', function(e) {
        e.preventDefault();
        post(API.signout).then(() => location.reload()).catch(() => location.reload());
      });
    }

    return { init, open, close };
  })();

  /* ─────────────────────────────────────────
     NOTICE BANNER
  ───────────────────────────────────────── */
  function initNotice() {
    $(document).on('click', '.notice-close', function() {
      const $b = $(this).closest('.notice-banner');
      $b.css({ transition: 'opacity .25s, max-height .35s, margin .35s, padding .35s', overflow: 'hidden', opacity: 0, maxHeight: $b.outerHeight() });
      requestAnimationFrame(() => $b.css({ maxHeight: 0, marginBottom: 0, padding: 0 }));
      setTimeout(() => $b.remove(), 380);
    });
  }

  /* ─────────────────────────────────────────
     INTERSECTION OBSERVER — animate-entry
  ───────────────────────────────────────── */
  function initAnimations() {
    const io = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) { $(e.target).addClass('visible'); io.unobserve(e.target); }
      });
    }, { threshold: 0.06 });

    document.querySelectorAll('.animate-entry, .forum-row, .thread-card, .post-card, .sidebar-block').forEach(el => {
      io.observe(el);
      // Viewport'ta olanları hemen göster
      const r = el.getBoundingClientRect();
      if (r.top < window.innerHeight) $(el).addClass('visible');
    });
  }

  /* ─────────────────────────────────────────
     COUNTER ANIMATION
  ───────────────────────────────────────── */
  function initCounters() {
    const parse  = s => s.trim().endsWith('k') ? parseFloat(s) * 1000 : parseFloat(s);
    const format = (n, o) => o.trim().endsWith('k') ? (n/1000).toFixed(1)+'k' : Math.round(n).toString();

    const io = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (!e.isIntersecting) return;
        io.unobserve(e.target);
        const el  = e.target;
        const org = el.textContent.trim();
        const tgt = parse(org);
        if (isNaN(tgt)) return;
        const dur = 900, t0 = performance.now();
        const tick = now => {
          const p = Math.min((now - t0) / dur, 1);
          const v = 1 - Math.pow(2, -10 * p);
          el.textContent = format(tgt * v, org);
          p < 1 ? requestAnimationFrame(tick) : (el.textContent = org);
        };
        requestAnimationFrame(tick);
      });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-val, .st-val, .num').forEach(el => io.observe(el));
  }

  /* ─────────────────────────────────────────
     FILTER TABS
  ───────────────────────────────────────── */
  function initTabs() {
    $(document).on('click', '.filter-tab', function(e) {
      e.preventDefault();
      $(this).closest('.filter-tabs').find('.filter-tab').removeClass('active');
      $(this).addClass('active');
    });
    $(document).on('click', '.header-tab', function(e) {
      e.preventDefault();
      $(this).closest('.header-tabs').find('.header-tab').removeClass('active');
      $(this).addClass('active');
    });
    $(document).on('click', '.cat-nav-item', function(e) {
      e.preventDefault();
      $('.cat-nav-item').removeClass('active');
      $(this).addClass('active');
    });
    $(document).on('click', '.profile-tab-btn', function() {
      $(this).closest('.profile-tab-head').find('.profile-tab-btn').removeClass('active');
      $(this).addClass('active');
      const tab = $(this).data('tab');
      $(this).closest('.profile-tab-content').find('.profile-tab-pane').removeClass('active');
      $(`#ptab-${tab}`).addClass('active');
    });
  }

  /* ─────────────────────────────────────────
     ESCAPE KEY
  ───────────────────────────────────────── */
  function initEscape() {
    $(document).on('keydown', e => {
      if (e.key !== 'Escape') return;
      drawer.close();
      searchOverlay.close();
      dropdowns.closeAll();
      auth.close();
    });
  }

  /* ─────────────────────────────────────────
     INIT
  ───────────────────────────────────────── */
  function init() {
    theme.init();
    navbar.init();
    drawer.init();
    dropdowns.init();
    searchOverlay.init();
    notifications.init();
    auth.init();
    initNotice();
    initAnimations();
    initCounters();
    initTabs();
    initEscape();
  }

  return { init, API, get, post, put, del, toast, auth, notifications };
})();

$(document).ready(() => zForum.init());
