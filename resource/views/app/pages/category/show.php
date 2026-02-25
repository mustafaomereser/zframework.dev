@extends('app.main')
@section('body')
<div class="page-header">
    <div class="container">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;padding-bottom:16px;">
            <div>
                <h1 class="page-title" style="font-size:18px;"><?= $category['title'] ?></h1>
            </div>
            <div style="display:flex;gap:8px;align-items:center;">
                <a data-modal="<?= route('topics.create') ?>?c=<?= $category['slug'] ?>" class="btn-new"><i class="fas fa-plus"></i> Yeni Konu Oluştur</a>
            </div>
        </div>
    </div>
</div>
<div class="container my-3">
    <?php /*
    <!-- Filter bar -->
    <div class="filter-bar">
        <div class="filter-tabs">
            <a href="#" class="filter-tab active">Tümü</a>
            <a href="#" class="filter-tab">Cevaplanmış</a>
            <a href="#" class="filter-tab">Cevaplanmamış</a>
        </div>
        <select class="filter-select">
            <option>Son Eklenen</option>
            <option>En Popüler</option>
            <option>En Çok Görüntülenen</option>
        </select>
    </div>
*/ ?>
    <!-- Thread list head -->
    <div class="thread-list-head">
        <div>Konu</div>
        <div style="text-align:center;">Cevap</div>
        <div style="text-align:center;">Görünüm</div>
    </div>

    <div id="threadList">
        <?= view('app.components.topics', ['items' => $topics['items']]) ?>
    </div>
    <?= $topics['links']() ?>
</div>
@endsection