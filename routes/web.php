<?php

use App\Http\Controllers\ProfileController;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/chat/{buddy}',function($buddy){
//     return Inertia::render('Chat',[
//         'buddy' => $buddy
//     ]);
// })->name('chatIndex');

Route::middleware(['auth','verified','status'])->group(function(){
    Route::get('/chat/{id?}', function($id = null) {
        return Inertia::render('Chat', [
            'buddies'  => User::getBuddies(),
            'buddy'    => User::findOrFail($id),
            'messages' => Message::getMessages($id)
        ]);
    })->name('chat');
    });
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';