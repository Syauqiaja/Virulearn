<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UnityController;
use App\Http\Controllers\UserController;
use App\Livewire\Activities\Detail as ActivitiesDetail;
use App\Livewire\Activities\EditMaterial;
use App\Livewire\Activities\EditTests;
use App\Livewire\Activities\Index as ActivityIndex;
use App\Livewire\Activities\TestDetail;
use App\Livewire\Admin\Article\Index as AdminArticleIndex;
use App\Livewire\Admin\Article\Edit as AdminArticleEdit;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\ExamTest;
use App\Livewire\Home;
use App\Livewire\Report\Index as ReportIndex;
use App\Livewire\User\Detail;
use App\Livewire\User\Index;
use App\Livewire\Viewer3D\Index as Viewer3DIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Handle root route based on auth status
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('home')
        : redirect()->route('login');
})->name('root');

// Authenticated user routes
Route::middleware('auth')->group(function(){
    Route::get('/home', Home::class)->name('home');
    Route::get('/activity', ActivityIndex::class)->name('activities.index');
    Route::delete('/activity/{id}', ActivityIndex::class)->name('activities.delete');
    Route::get("/activity/material/{id}/edit", EditMaterial::class)->name('activities.material.edit');
    Route::get("/activity/tests/{type}/{id}/edit", EditTests::class)->name('activities.tests.edit');
    Route::get("/activity/{id}/detail", ActivitiesDetail::class)->name('activities.detail');
    Route::get("/activity/{id}/detail/{type}", TestDetail::class)->name('activities.test');
    Route::get("/exam/{id}/", ExamTest::class)->name('exam');
    Route::get('/logout', LogoutController::class)->name('logout');
    
    Route::get('/users', Index::class)->name('user.index');
    Route::get('/users/datatable', [UserController::class, 'index'])->name('user.datatable');
    Route::get('/users/{user}/detail', Detail::class)->name('user.detail');
    Route::get('/users/{user}/detail/chart',[ UserController::class, 'chart'])->name('user.detail.chart');

    Route::get('/article/list', AdminArticleIndex::class)->name('article.list');
    Route::get('/article/edit', AdminArticleEdit::class)->name('article.edit');

    Route::get('/viewer', Viewer3DIndex::class)->name('viewer');
});

// Guest routes
Route::middleware('guest')->group(function(){
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});