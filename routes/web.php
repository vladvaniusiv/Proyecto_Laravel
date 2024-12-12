<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//use Laravel\Socialite\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
// Define la ruta de inicio y la asocia al controlador
Route::get('/', [DefaultController::class, 'home'])->name('home');

// Ruta para dashboard protegida por autenticación
Route::get('/dashboard', [DefaultController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')
        ->setScopes(['read:user', 'public_repo'])
        ->redirect();
});
 
Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
 
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);
 
    Auth::login($user);
 
    return redirect('/dashboard');
});

Route::get('auth/google/redirect',function(){
    return Socialite::driver('google')->redirect();
});

Route::get('auth/google/callback', function(){
    
    $user_google=Socialite::driver('google')->stateless()->user();
    $user=User::updateOrCreate([
        'google_id'=>$user_google->id,
    ],[
        'name'=>$user_google->name,
        'email'=>$user_google->email,
        'password' => bcrypt('11111111'),
    ]);
    Auth::login($user);
    return redirect('/dashboard');
    
});





require __DIR__.'/auth.php';
require __DIR__.'/bank.php';