@extends('app.main')
@section('body')
<div class="container my-3">
    <div class="row g-4">
        <div class="col-xl-9 col-lg-9">
            <!-- Notice -->
            <div class="notice-banner">
                <i class="fas fa-info-circle notice-icon"></i>
                <div>
                    <p class="notice-title">zFramework v2.8.0 yayında!</p>
                    <p class="notice-text">
                        Modül sistemi, <code style="font-family:var(--font-code);font-size:11px;background:var(--code-bg);padding:1px 5px;border-radius:3px;">php terminal</code> komutları ve AutoSSL desteğiyle yeni sürüm geldi.
                        <a href="#">Değişiklik notlarını gör →</a>
                    </p>
                </div>
                <button class="notice-close" onclick="this.closest('.notice-banner').remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Filter bar -->
            <div class="filter-bar">
                <div class="filter-tabs">
                    <a href="#" class="filter-tab active"><?= _l('main.all') ?></a>
                    <a href="#" class="filter-tab"><?= _l('main.question') ?></a>
                    <a href="#" class="filter-tab"><?= _l('main.discussion') ?></a>
                    <a href="#" class="filter-tab"><?= _l('main.project') ?></a>
                    <a href="#" class="filter-tab"><?= _l('main.announcement') ?></a>
                </div>
                <div class="filter-right">
                    <select class="filter-select">
                        <option><?= _l('main.newest') ?></option>
                        <option><?= _l('main.oldest') ?></option>
                        <option><?= _l('main.most-active') ?></option>
                        <option><?= _l('main.most-viewed') ?></option>
                    </select>
                </div>
            </div>

            <!-- ── CATEGORIES ──────── -->
            <div class="section-label"><i class="fas fa-layer-group fa-fw"></i> <?= _l('main.categories') ?></div>

            <!-- Cat: Genel -->
            <component data-type="categories"></component>

            <!-- ── RECENT THREADS ───── -->
            <div class="section-label" style="margin-top:28px;">
                <i class="fas fa-clock fa-fw"></i> <?= _l('main.recent-threads') ?>
            </div>


            <component data-type="topics" data-query="last=true"></component>

            <?php /*
            <!-- Pagination -->
            <div class="pager">
                <a href="#" class="pager-btn disabled"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="pager-btn active">1</a>
                <a href="#" class="pager-btn">2</a>
                <a href="#" class="pager-btn">3</a>
                <span class="pager-btn" style="cursor:default;border:none;background:none;color:var(--txt-muted);">…</span>
                <a href="#" class="pager-btn">14</a>
                <a href="#" class="pager-btn"><i class="fas fa-chevron-right"></i></a>
            </div>
            */
            ?>

        </div>

        <!-- ── SIDEBAR ────────────────────────────── -->
        <div class="col-xl-3 col-lg-3">

            <!-- Stats -->
            <div class="sidebar-block animate-entry stagger-3">
                <div class="sidebar-block-head">
                    <h3><i class="fas fa-chart-bar fa-fw me-1"></i> <?= _l('main.statistics') ?></h3>
                </div>
                <div class="stat-strip">
                    <div class="stat-cell">
                        <div class="stat-val">1.2k</div>
                        <div class="stat-lbl"><?= _l('main.members') ?></div>
                    </div>
                    <div class="stat-cell">
                        <div class="stat-val">741</div>
                        <div class="stat-lbl"><?= _l('main.topic') ?></div>
                    </div>
                    <div class="stat-cell">
                        <div class="stat-val">4.8k</div>
                        <div class="stat-lbl"><?= _l('main.message') ?></div>
                    </div>
                    <div class="stat-cell">
                        <div class="stat-val" style="color:var(--accent-2);">23</div>
                        <div class="stat-lbl"><?= _l('main.online') ?></div>
                    </div>
                </div>
            </div>

            <!-- Online members -->
            <div class="sidebar-block animate-entry stagger-4">
                <div class="sidebar-block-head">
                    <h3><i class="fas fa-circle fa-fw me-1" style="color:var(--accent-2);font-size:9px;"></i> <?= _l('main.online') ?></h3>
                    <a href="#"><?= _l('main.see-all') ?></a>
                </div>
                <div class="sidebar-block-body">
                    <div class="online-member">
                        <div class="online-avatar" style="background:rgba(46,107,230,.15);color:var(--accent);">MO</div>
                        <div>
                            <div class="online-name">mustafaomereser</div>
                            <div class="online-role"><?= _l('main.role-developer') ?></div>
                        </div>
                        <div class="online-dot"></div>
                    </div>
                </div>
            </div>

            <!-- Tags -->
            <div class="sidebar-block animate-entry stagger-5">
                <div class="sidebar-block-head">
                    <h3><i class="fas fa-tags fa-fw me-1"></i> <?= _l('main.tags') ?></h3>
                </div>
                <div class="tag-list">
                    <a href="#" class="tag">Route</a>
                    <a href="#" class="tag">Model</a>
                    <a href="#" class="tag">Migration</a>
                    <a href="#" class="tag">Middleware</a>
                    <a href="#" class="tag">Auth</a>
                    <a href="#" class="tag">Blade</a>
                    <a href="#" class="tag">Cache</a>
                    <a href="#" class="tag">API</a>
                    <a href="#" class="tag">Validator</a>
                    <a href="#" class="tag">Observer</a>
                    <a href="#" class="tag">Terminal</a>
                    <a href="#" class="tag">AutoSSL</a>
                    <a href="#" class="tag">cPanel</a>
                    <a href="#" class="tag">Crypter</a>
                    <a href="#" class="tag">Mail</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection