<?php

use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\HomePage;
use App\Livewire\ProfilePage;
use App\Livewire\SearchPage;
use App\Livewire\SettingsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::middleware('auth')->group(function (){
    Route::get('/', HomePage::class)->name('home');
    Route::get('/search', SearchPage::class)->name('search');
    Route::get('/profile', ProfilePage::class)->name('profile');
    Route::get('/settings', SettingsPage::class)->name('settings');
    Route::post('/logout', function (Request $request){
        //Remove the user from laravel's auth system
        Auth::logout();

        //Destroy the current session because the old session id can still be used (session fixation attack risk)
        session()->invalidate();

        //Generate a new CSRF token because the old token can still be used (CSRF attack risk)
        session()->regenerateToken();

        //Redirect to login page
        return redirect()->route('login');
    })->name('logout');
});
Route::middleware('guest')->group(function (){
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
});
