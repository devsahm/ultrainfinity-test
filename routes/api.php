<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){

    Route::prefix('articles')->group(function(){
        Route::post('/', [ArticleController::class, 'create']);
        Route::get('/', [ArticleController::class, 'index']);
        Route::get('{article}', [ArticleController::class, 'showArticle']);
        Route::post('{article}/comment', [CommentController::class, 'create']);
        Route::get('{article}/comment', [ArticleController::class, 'showComments']);
        Route::post('{article}/like', [ArticleController::class, 'addLike']);
    });
});
