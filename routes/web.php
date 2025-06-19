<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Livewire\Activities\Detail as ActivitiesDetail;
use App\Livewire\Activities\EditMaterial;
use App\Livewire\Activities\EditTests;
use App\Livewire\Activities\Index as ActivityIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Home;
use App\Livewire\Report\Index as ReportIndex;
use App\Livewire\User\Detail;
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
    Route::get('/logout', LogoutController::class)->name('logout');

    Route::get('/report', ReportIndex::class)->name('report.index');
    Route::get('/users/datatable', [UserController::class, 'index'])->name('users.datatable');
    Route::get('/users/{user}/detail', Detail::class)->name('user.detail');
});

// Guest routes
Route::middleware('guest')->group(function(){
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});