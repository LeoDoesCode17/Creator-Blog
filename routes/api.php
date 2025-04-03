<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Friendship;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/{senderId}/{receiverId}', function ($senderId, $receiverId) {
    $friendship = Friendship::getRelationship($senderId, $receiverId);
    return response()->json([
        'code' => 200,
        'message' => 'ok',
        'data' => [
            'friendship' => $friendship,
        ],
    ]);
});
