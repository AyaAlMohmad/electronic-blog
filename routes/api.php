<?php

use App\Http\Controllers\API\AboutUsController;
use App\Http\Controllers\API\AuthController ;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\SectionController;
use App\Http\Controllers\API\SubSectionController;
use App\Http\Controllers\API\WriterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
// Route::post('refresh', [AuthController::class, 'refresh']);
// routes/api.php
Route::middleware('jwt.refresh')->post('/refresh', [AuthController::class, 'refresh']);
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');
Route::post('register', [AuthController::class, 'register']);
Route::post('profile', [AuthController::class, 'updateProfile'])->middleware('auth:api');
Route::middleware('auth:api')->group(function(){
    Route::get('sections',[SectionController::class, 'index']);
    Route::get('sections/{id}',[SectionController::class, 'show']);

    Route::get('sub-sections',[SubSectionController::class, 'index']);
    Route::get('sub-sections/{id}',[SubSectionController::class, 'show']);
    Route::get('sub-sections/{id}/details', [SubSectionController::class, 'showSubsectionDetails']);
 

Route::get('/about-us', [AboutUsController::class, 'index']);
Route::get('/about-us/{id}', [AboutUsController::class, 'show']);


Route::get('/contact-us', [ContactUsController::class, 'index']);
Route::get('/contact-us/{id}', [ContactUsController::class, 'show']);
Route::apiResource('posts', PostController::class);
Route::get('/post/most-interactive', [PostController::class, 'mostInteractivePosts']);
Route::get('/post/latest', [PostController::class, 'latestPosts']);
Route::get('/post/writer/{writerId}', [PostController::class, 'postsByWriter']);
Route::get('/writer/posts', [WriterController::class, 'myPostsWithDetails']);
Route::get('/writers/allposts', [WriterController::class, 'allWritersWithPosts']);
Route::get('/writers/{id}', [WriterController::class, 'postsWithDetailsByWriter']);

Route::get('/writers', [WriterController::class, 'index']);
Route::post('/reply-to-comment', [WriterController::class, 'replyToComment']);
Route::get('/post/comments-with-replies/{postId}', [WriterController::class, 'getPostCommentsWithReplies']);
Route::get('/writer/notifications', [WriterController::class, 'myNotifications']);
Route::prefix('posts/{id}')->group(function () {
    // Like routes
    Route::post('/like', [LikeController::class, 'likePost']);
    Route::delete('/like', [LikeController::class, 'unlikePost']);
    Route::get('/like/check/', [LikeController::class, 'checkLike']);
    
    // Comment routes
    Route::get('/comments', [CommentController::class, 'getComments']);
    Route::post('/comments', [CommentController::class, 'addComment']);
    Route::delete('/comments/{commentId}', [CommentController::class, 'deleteComment']);
});
});