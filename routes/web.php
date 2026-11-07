<?php

use App\Livewire\Admin\Access\AccessManager;
use App\Livewire\Admin\Media\MediaManager;
use App\Livewire\Admin\Settings\SettingsManager;
use App\Livewire\Admin\Theme\ThemeStudio;
use App\Services\IconRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Fallback & Direct Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Breeze Compatibility Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Corporate CMS Administration Panel (RBAC Protected)
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth',
    'role:Super Administrator|Administrator|Editor|Content Manager',
])->prefix('admin')->name('admin.')->group(function () {

    // Executive Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Global Settings Studio
    Route::get('/settings', SettingsManager::class)
        ->middleware('permission:settings.manage')
        ->name('settings');

    // Access Control Studio (Users & Permissions)
    Route::get('/access', AccessManager::class)
        ->middleware('permission:users.view|roles.manage')
        ->name('access');

    // Theme Customizer Studio
    Route::get('/theme', ThemeStudio::class)
        ->middleware('permission:theme.manage')
        ->name('theme');

    // Media Asset Library
    Route::get('/media', MediaManager::class)
        ->middleware('permission:media.view')
        ->name('media');

    // Ultra-Fast Cached JSON Endpoint for Icon Picker (Zero Page Bloat)
    Route::get('/api/icons-manifest', function () {
        return response()->json(IconRegistry::getManifest())
            ->header('Cache-Control', 'public, max-age=604800, immutable');
    })->name('icons.manifest');
    
    // User Profile
    Route::view('/profile', 'profile')->name('profile');
});

/*
|--------------------------------------------------------------------------
| Breeze Livewire Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
