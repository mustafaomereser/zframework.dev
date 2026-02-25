<?php

use App\Helpers\Reactions;

foreach ($items as $item): $author = $item['author']();
    $total = Reactions::total('post-' . $item['id']); ?>
    <div class="post-card">
        <div class="post-header">
            <div class="post-author">
                <div class="post-avatar" style="background:rgba(15,154,107,.12);color:var(--accent-2);"><?= strtoupper(substr($author['username'], 0, 2)) ?></div>
                <div>
                    <div class="post-author-name"><a href="<?= route('profile.show', ['id' => $author['id']]) ?> style=" color:var(--txt);text-decoration:none;"><?= $author['username'] ?></a></div>
                    <div class="post-author-role" style="color:var(--txt-muted);">Üye</div>
                </div>
            </div>
            <div class="post-meta">
                <span class="post-time"><i class="fas fa-clock me-1"></i><?= zFramework\Core\Helpers\Date::format($item['created_at'], 'd M Y, H:i') ?></span>
            </div>
        </div>
        <div class="post-body"><?= $item['content'] ?></div>
        <div class="post-footer">
            <div class="post-reactions">
                <button class="reaction-btn <?= Reactions::isReacted('post-' . $item['id'], 1) ? 'liked' : null ?>" data-target="post-<?= $item['id'] ?>" data-type="1"><i class="fas fa-thumbs-up"></i><span><?= $total[1] ?? 0 ?></span></button>
                <button class="reaction-btn <?= Reactions::isReacted('post-' . $item['id'], 2) ? 'liked' : null ?>" data-target="post-<?= $item['id'] ?>" data-type="2"><i class="fas fa-lightbulb"></i><span><?= $total[2] ?? 0 ?></span></button>
            </div>
            <div style="font-size:11px;color:var(--txt-muted);"><span>#<?= $start++ ?></span></div>
        </div>
    </div>
<?php endforeach ?>