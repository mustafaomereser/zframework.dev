@extends('app.main')
@section('body')
<div class="page-header">
    <div class="container">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;padding-bottom:16px;">
            <div>
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                    <span class="badge-pill badge-cat"><?= $topic['category']()['title'] ?></span>
                </div>
                <h1 class="page-title" style="font-size:18px;"><?= $topic['title'] ?></h1>
                <div style="display:flex;align-items:center;gap:14px;margin-top:6px;flex-wrap:wrap;">
                    <a href="<?= route('profile.show', ['id' => $author['id']]) ?>" style="font-size:12px;color:var(--txt-muted);font-family:var(--font-code);"><i class="fas fa-user me-1"></i><?= $author['username'] ?></a>
                    <span style="font-size:12px;color:var(--txt-muted);font-family:var(--font-code);"><i class="fas fa-calendar me-1"></i><?= zFramework\Core\Helpers\Date::format($topic['created_at'], 'd M Y') ?></span>
                    <span style="font-size:12px;color:var(--txt-muted);font-family:var(--font-code);"><i class="fas fa-eye me-1"></i><?= $seens ?> görüntülenme</span>
                    <span style="font-size:12px;color:var(--txt-muted);font-family:var(--font-code);"><i class="fas fa-comment me-1"></i>0 cevap</span>
                </div>
            </div>
            <div style="display:flex;gap:8px;align-items:center;">
                <button class="btn-icon" title="Kaydet"><i class="fas fa-bookmark"></i></button>
                <button class="btn-icon" title="Paylaş"><i class="fas fa-share-alt"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- MAIN -->
<div style="padding:24px 0 48px;">
    <div class="container">
        <div class="row g-4">
            <div class="col-xl-12">
                <?= view('app.components.posts', ['items' => $posts['items'], 'start' => $posts['start']]) ?>

                <!-- Reply Form -->
                <form id="reply-form" class="reply-form-wrap">
                    <?= csrf() ?>
                    <input type="hidden" name="target" value="topic-<?= $topic['id'] ?>">
                    <div class="reply-form-title"><i class="fas fa-reply" style="color:var(--accent);"></i> Cevap Yaz</div>
                    <div class="reply-toolbar">
                        <button class="toolbar-btn" title="Kalın"><i class="fas fa-bold"></i></button>
                        <button class="toolbar-btn" title="İtalik"><i class="fas fa-italic"></i></button>
                        <button class="toolbar-btn" title="Kod"><i class="fas fa-code"></i></button>
                        <button class="toolbar-btn" title="Blok kod"><i class="fas fa-file-code"></i></button>
                        <button class="toolbar-btn" title="Link"><i class="fas fa-link"></i></button>
                        <button class="toolbar-btn" title="Alıntı"><i class="fas fa-quote-right"></i></button>
                    </div>
                    <textarea class="reply-textarea" name="content" placeholder="Cevabınızı yazın... Kod için ``` kullanabilirsiniz."></textarea>
                    <div class="reply-footer">
                        <div style="font-size:12px;color:var(--txt-muted);">
                            <i class="fas fa-info-circle me-1"></i>Markdown desteklenmektedir
                        </div>
                        <div style="display:flex;gap:8px;">
                            <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fas fa-paper-plane me-1"></i>Gönder
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $posts['links']() ?>
@endsection
@section('footer')
<script>
    // Like toggle
    $(document).on('click', '.reaction-btn', function() {
        const $btn = $(this);
        const id = $btn.data('id');
        $.post('<?= route('reactions.toggle') ?>', {
            _token: csrf,
            target: $btn.data('target'),
            type: $btn.data('type')
        }, e => {
            if (e.status == 1) $btn.addClass('liked');
            else $btn.removeClass('liked');
            const $num = $btn.find('span');
            $num.text(parseInt($num.text()) + (e.status == 2 ? -1 : 1));
        });
    });

    $('#reply-form').sbmt((form, btn) => {
        $.core.btn.spin(btn);
        $.post('<?= route('posts.store') ?>', $.core.SToA(form), e => {
            if (e.status) return location.reload();
            $.showAlerts(e.alerts);
            $.core.btn.unset(btn);
        });
    })
</script>
@endsection