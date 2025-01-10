<?php

use App\Http\Controllers\API\v1\UserController as UserControllerV1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user/')->group(function () {
    Route::post('add', [UserControllerV1::class, 'store']);
    Route::post('all', [UserControllerV1::class, 'index']);
    Route::post('edit', [UserControllerV1::class, 'update']);
    Route::post('delete', [UserControllerV1::class, 'destroy']);
});
