<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MemberPointController;
use  App\Http\Controllers\ProgramMemberController;

Route::middleware(['auth'])->group(function () {
    Route::get('/articles', [ArticleController::class, 'content'])->name('articles.content');
    Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.clickPoint');

    Route::get('/programs/joint', [ProgramMemberController::class, 'create'])->name('programs.joint');
    Route::post('/programs/joint', [ProgramMemberController::class, 'store'])->name('programs.joint.membership');

    Route::post('/api/record-read-time', [MemberPointController::class, 'pointReadTime'])->name('programs.joint.membership');
});
