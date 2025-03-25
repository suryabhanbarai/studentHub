<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolApiController;

Route::get('/user', [SchoolApiController::class, 'index'])->middleware("encrypt.decrypt");

Route::get('/generate-encrypted-data', function () {
    $data = ['password' => 'admin123', 'login_id' => 1];
    $encrypted = encrypt(json_encode($data));
    return response()->json([
        'encrypted_data' => $encrypted,
        'url' => url('/api/schools?encrypted_data=' . urlencode($encrypted)),
    ]);
});
