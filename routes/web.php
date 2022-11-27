<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\QuestionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('welcome');
    Route::get('/lesson/{id}', [MainController::class, 'lesson'])->name('lesson');
    Route::get('/questions/{id}', [MainController::class, 'questions'])->name('questions');
    Route::post('/select-question/{id}', [MainController::class, 'selectQuestion'])->name('questions.select');
    Route::get('/post-question/{id}', [MainController::class, 'postQuestion'])->name('question.post');
    Route::post('/questions/{id}/store', [QuestionsController::class, 'store'])->name('questions.store');

//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->middleware(['auth'])->name('dashboard');
});
require __DIR__.'/auth.php';
