<?php

use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\HomePage;
use App\Livewire\ProfilePage;
use App\Livewire\SearchPage;
use App\Livewire\SettingsPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/login', LoginPage::class)->name('login');
Route::get('/register', RegisterPage::class)->name('register');
Route::get('/search', SearchPage::class)->name('search');
Route::get('/profile', ProfilePage::class)->name('profile');
Route::get('/settings', SettingsPage::class)->name('settings');
