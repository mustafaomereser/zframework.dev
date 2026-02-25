<?php foreach ($items as $item): ?>
    <div href="<?= route('category.show', ['id' => $item['slug']]) ?>" class="forum-row">
        <div class="forum-row-icon-wrap" style="color:<?= $item['color'] ?>;">
            <i class="<?= $item['icon'] ?>"></i>
        </div>
        <div class="forum-row-body">
            <h2 class="forum-row-title"><?= $item['title'] ?></h2>
            <p class="forum-row-desc"><?= $item['description'] ?></p>
        </div>
        <div class="forum-row-stats">
            <span class="st-val"><?= $item['topics']()->count() ?></span>
            <span class="st-lbl"><?= _l('main.topic') ?></span>
        </div>
        <div class="forum-row-stats">
            <span class="st-val"><?= $item['posts']() ? $item['posts']()->count() : 0 ?></span>
            <span class="st-lbl"><?= _l('main.message') ?></span>
        </div>
    </div>
<?php endforeach ?>