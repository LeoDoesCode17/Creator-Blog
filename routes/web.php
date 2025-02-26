<?php

use App\Livewire\Login;
use App\Livewire\SearchPage;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('home');
Route::get('/search', SearchPage::class)->name('search');
