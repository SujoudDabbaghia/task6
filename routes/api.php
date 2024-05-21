<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\AuthAdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('regiter',[AuthController::class,'register']);
// Route::post('login',[AuthController::class,'login']);
// Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
// Route::get('test',[AuthController::class,'test'])->middleware('auth:sanctum');

Route::get('/login', [ AuthAdminController::class, 'login'])->name('login');
Route::get('/logout', [ AuthAdminController::class, 'logout'])->name('logout');

Route::get('/login', [AuthUserController::class, 'login'])->name('login');
Route::get('/logout', [ AuthUserController::class, 'logout'])->name('logout');

Route::apiResource('post', PostController::class);
Route::get('str', [PostController::class, 'str'])->name('str');

Route::apiResource('comment', CommentController::class);
