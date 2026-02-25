<?php

use zFramework\Core\Facades\Str;

foreach ($items as $item): $author = $item['author']() ?>
    <div href="<?= route('topics.show', ['id' => $item['slug']]) ?>" class="thread-card">
        <div class="thread-main">
            <div class="thread-status-dot pinned"></div>
            <div class="thread-info">
                <div class="thread-badges">
                    <?php /*
                    <span class="badge-pill badge-pin"><i class="fas fa-thumbtack fa-fw"></i> <?= _l('main.badge-pinned') ?></span>
                    <span class="badge-pill badge-solved"><i class="fas fa-check fa-fw"></i> <?= _l('main.badge-solved') ?></span>
                    <span class="badge-pill badge-hot"><i class="fas fa-fire fa-fw"></i> <?= _l('main.badge-hot') ?></span>
*/ ?>
                    <span class="badge-pill badge-cat"><?= $item['category']()['title'] ?></span>
                </div>
                <div class="thread-title"><?= $item['title'] ?></div>
                <div class="thread-meta">
                    <a href="<?= route('profile.show', ['id' => $author['id']]) ?>" class="thread-meta-item"><span class="user-tag">@<?= $author['username'] ?></span></a>
                    <span class="thread-meta-item"><i class="fas fa-calendar"></i> <?= zFramework\Core\Helpers\Date::format($item['created_at'], 'd M Y, H:i') ?></span>
                </div>
            </div>
        </div>
        <div class="thread-replies">
            <span class="num"><?= $item['posts']()->count() ?></span>
            <span class="lbl"><?= _l('main.reply') ?></span>
        </div>
        <div class="thread-views">
            <span class="num"><?= $item['views']()->count() ?></span>
            <span class="lbl"><?= _l('main.views') ?></span>
        </div>
    </div>
<?php endforeach ?>