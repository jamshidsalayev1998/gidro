<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::post('login' , [AuthenticatedSessionController::class,'login']);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {

    $user = $request->user();
    $token = $user->createToken('authToken')->plainTextToken;
    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
});
Route::group(['middleware' => ['auth:sanctum']] , function (){
    Route::get('product' , [ProductController::class,'index']);
    Route::post('product' , [ProductController::class,'store']);
    Route::put('product/{product}' , [ProductController::class,'update']);
    Route::delete('product/{product}' , [ProductController::class,'destroy']);
});
