<?php

use App\Http\Controllers\MessageController;
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

Route::middleware(['auth', 'verified', 'status'])->group(function () {
    Route::get('/chat/{id?}', function($id = null) {
        $buddies = User::getBuddies();
        if (is_null($id) && $buddies->isNotEmpty()) {
            $randomBuddy = $buddies->random();
            return redirect()->route('chat', ['id' => $randomBuddy->id]);
        }

        return Inertia::render('Chat', [
            'buddies'  => $buddies,
            'buddy'    => User::findOrFail($id),
            'messages' => Message::getMessages($id)
        ]);
    })->name('chat');

    Route::post('/chat', [MessageController::class,'store']);
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