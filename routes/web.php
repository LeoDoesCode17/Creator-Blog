<?php

use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\HomePage;
use App\Livewire\ProfilePage;
use App\Livewire\SearchPage;
use App\Livewire\SettingsPage;
use App\Livewire\UserProfilePage;
use App\Models\Friendship;
use App\Models\User;
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
    Route::get('/users/{username}', UserProfilePage::class)->name('user.show');
});
Route::middleware('guest')->group(function (){
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
});
Route::get('/{id}/friends', function ($id) {
    $friends = Friendship::where('status', 'accepted')
        ->where(
            function ($query) use($id){
                $query->where('user_id', $id)->orWhere('friend_id', $id);
        })
        ->with(['sender', 'receiver'])
        ->get()
        ->map(function ($friendship) use($id){
            return $friendship->user_id == $id ? $friendship->receiver : $friendship->sender;
        });
    
    return response()->json([
        'friends' => $friends,
    ]);
});