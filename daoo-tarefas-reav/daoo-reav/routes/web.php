<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// comments

Route::get('comments',[CommentController::class,'index']);

Route::get('comment/{id}',[CommentController::class,'show']);

Route::get('comment', [CommentController::class,'create']);

Route::post('comment', [CommentController::class,'store']);

Route::get('comment/{id}/edit', [
    CommentController::class,
    'edit'
])->name('comment.edit');

Route::post('comment/{id}/update', [
    CommentController::class,
    'update'
])->name('comment.update');

Route::get('comment/{id}/delete', [
    CommentController::class,
    'delete'
])->name('comment.delete');

Route::post('comment/{id}/remove', [
    CommentController::class,
    'destroy'
])->name('comment.remove');

// users

Route::get('users',[UserController::class,'index']);

Route::get('user/{id}',[UserController::class,'show']);

Route::get('user', [UserController::class,'create']);

Route::post('user', [UserController::class,'store']);

Route::get('user/{id}/edit', [
    UserController::class,
    'edit'
])->name('user.edit');

Route::post('user/{id}/update', [
    UserController::class,
    'update'
])->name('user.update');

Route::get('user/{id}/delete', [
    UserController::class,
    'delete'
])->name('user.delete');

Route::post('user/{id}/remove', [
    UserController::class,
    'destroy'
])->name('user.remove');

// topics

Route::get('topics',[TopicController::class,'index']);

Route::get('topic/{id}',[TopicController::class,'show']);

Route::get('topic', [TopicController::class,'create']);

Route::post('topic', [TopicController::class,'store']);

Route::get('topic/{id}/edit', [
    TopicController::class,
    'edit'
])->name('topic.edit');

Route::post('topic/{id}/update', [
    TopicController::class,
    'update'
])->name('topic.update');

Route::get('topic/{id}/delete', [
    TopicController::class,
    'delete'
])->name('topic.delete');

Route::post('topic/{id}/remove', [
    TopicController::class,
    'destroy'
])->name('topic.remove');





