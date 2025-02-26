<?php

use App\Livewire\HomePage;
use App\Livewire\Login;
use App\Livewire\SearchPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/search', SearchPage::class)->name('search');
