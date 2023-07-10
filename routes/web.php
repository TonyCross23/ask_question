<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Models\QuestionComment;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'route'],function(){
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login',[AuthController::class,'postLogin'])->name('post.login');

    // register
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/register',[AuthController::class,'postRegister'])->name('post.register');
});

Route::group(['middleware'=>'auth'],function(){
    // home page
    Route::get('/',[QuestionController::class,'home'])->name('home');
    Route::get('/user/profile/edit',[PageController::class,'userProfile'])->name('profile');
    Route::post('/user/profile/edit',[PageController::class,'postUserProfile'])->name('post.profile');
    Route::get('profile/question',[QuestionController::class,'userQuestion'])->name('user.question');
    Route::get('/profile/save-question',[QuestionController::class,'showSaveQuestion'])->name('show.saveQusetion');

    // like
    Route::get('/question/like/{id}',[QuestionController::class,'like']);

    // comment
    Route::post('/question/comment/create',[QuestionController::class,'createComment']);
    Route::get('question/delete/{id}',[QuestionController::class,'questionDelete'])->name('question.delete');

    // question
    Route::get('/question-detail/{slug}',[QuestionController::class,'detail'])->name("question.detail");
    Route::post('/question/set/fix',[QuestionController::class,'setFix'])->name("question.fix");
    Route::post('/question/save',[QuestionController::class,'saveQuestion'])->name("question.save");

    // create question
    Route::get('/question/create',[QuestionController::class,'create'])->name('question.create');
    Route::post('/question/create',[QuestionController::class,'store'])->name('question.store');

    // logout
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
});