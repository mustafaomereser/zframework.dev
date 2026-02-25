<?php if ($page_count > 1): ?>
    <div class="pager">

        <!-- İlk Sayfa -->
        <a href="<?= str_replace("change_page_$uniqueID", 1, $url) ?>"
            class="pager-btn <?= $current_page == 1 ? 'disabled' : null ?>">
            <i class="fas fa-chevron-double-left"></i>
        </a>

        <!-- Önceki -->
        <a href="<?= str_replace("change_page_$uniqueID", ($current_page - 1), $url) ?>"
            class="pager-btn <?= $current_page == 1 ? 'disabled' : null ?>">
            <i class="fas fa-chevron-left"></i>
        </a>

        <!-- Sayfalar -->
        <?php foreach ($pages as $page) : ?>
            <?php if ($page['type'] === 'page') : ?>
                <a href="<?= $page['url'] ?>"
                    class="pager-btn <?= $page['current'] ? 'active' : null ?>">
                    <?= $page['page'] ?>
                </a>
            <?php elseif ($page['type'] === 'dot') : ?>
                <span class="pager-btn"
                    style="cursor:default;border:none;background:none;color:var(--txt-muted);">
                    …
                </span>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Sonraki -->
        <a href="<?= str_replace("change_page_$uniqueID", ($current_page + 1), $url) ?>"
            class="pager-btn <?= $current_page == $page_count ? 'disabled' : null ?>">
            <i class="fas fa-chevron-right"></i>
        </a>

        <!-- Son Sayfa -->
        <a href="<?= str_replace("change_page_$uniqueID", $page_count, $url) ?>"
            class="pager-btn <?= $current_page == $page_count ? 'disabled' : null ?>">
            <i class="fas fa-chevron-double-right"></i>
        </a>

    </div>
<?php endif ?>