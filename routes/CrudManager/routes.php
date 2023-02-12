<?php

## References Use
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('admin')->group(function () {
        ## References Routes
		Route::get('/', [ArticleController::class, 'index'])->name('admin.articles.index');
		Route::get('/create',  [ArticleController::class, 'index'])->name('admin.article.create');
    });
});