<?php

use App\Controllers\AuthController;
use App\Controllers\CategoriesController;
use App\Controllers\ComponentsController;
use App\Controllers\ForumsController;
use zFramework\Core\Route;
use App\Controllers\LanguageController;
use App\Controllers\PostsController;
use App\Controllers\ReactionsController;
use App\Controllers\TopicsController;

Route::get('/language/{lang}', [LanguageController::class, 'set'])->name('language');
Route::get('/auth-content', [AuthController::class, 'content'])->name('auth-content');

Route::middleware([App\Middlewares\Guest::class])->group(function () {
    Route::get('/auth', [AuthController::class, 'auth'])->name('auth-form');
    Route::post('/sign-in', [AuthController::class, 'signin'])->name('sign-in');
    Route::post('/sign-up', [AuthController::class, 'signup'])->name('sign-up');
});

Route::middleware([App\Middlewares\Auth::class])->group(function () {
    Route::any('/sign-out', [AuthController::class, 'signout'])->name('sign-out');
});


Route::pre('/topics')->group(function () {
    Route::resource('/', TopicsController::class);
});

Route::pre('/category')->group(function () {
    Route::resource('/', CategoriesController::class);
});

Route::pre('/posts')->group(function () {
    Route::resource('/', PostsController::class);
});

Route::pre('/reactions')->group(function () {
    Route::post('/', [ReactionsController::class, 'toggle'])->name('toggle');
});

Route::pre('/components')->group(function () {
    Route::get('/categories', [ComponentsController::class, 'categories']);
    Route::get('/topics', [ComponentsController::class, 'topics']);
});


Route::resource('/forums', ForumsController::class);
Route::redirect('/', route('forums.index'));


Route::get('/db-migrate', function () {
    echo "<style>body{background: black} pre {background: #111; font-size: 11pt; padding: 10px; border-radius: 5px}</style>";
    ob_start();
    zFramework\Kernel\Terminal::begin(['terminal', 'db', 'migrate', '--web']);
    $logs = ob_get_clean();
    echo "<pre>" . trim($logs) . "</pre>";
});
