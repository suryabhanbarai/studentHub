<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('schools', SchoolController::class);
    Route::get('school/{school}/pdf', [SchoolController::class, 'exportPdf']);
    Route::get('districts', function(Request $request) {
        return District::where('state_id', $request->state_id)->get();
    });
    Route::get('cities', function(Request $request) {
        return City::where('district_id', $request->district_id)->get();
    });
});

require __DIR__.'/auth.php';
