<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignInHandle;
use App\Http\Controllers\SignUpHandle;
use App\Http\Controllers\HomeHandle;
use App\Http\Controllers\FilmHandle;
use App\Http\Controllers\PromotionHandle;
use App\Http\Controllers\InfoHandle;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\CheckUser;
use App\Http\Controllers\AdminHomeHandle;
use App\Http\Controllers\AdminInfoAdd;
use App\Http\Controllers\AdminInfoEdit;
use App\Http\Controllers\AdminFilmHandle;
use App\Http\Controllers\AdminPromotionHandle;
use App\Http\Controllers\MemberHandle;
use App\Http\Controllers\AdminMemberHandle;
use App\Http\Controllers\AdminComingFilmInfoEdit;
use App\Http\Controllers\ComingFilmInfoHandle;

//Sign In Router
Route::get('/signin',[SignInHandle::class,'index'])->name('signin');

Route::post('/signin',[SignInHandle::class,'SignInHandle']);

////Sign Up Router
Route::get('/signup',[SignUpHandle::class,'index'])->name('signup');

Route::post('/signup',[SignUpHandle::class,'SignUpHandle']);

//User Router
Route::prefix('/')->middleware(CheckUser::class)->group(function () {
    Route::get('/',[HomeHandle::class,'index'])->name('home');

    Route::get('/film/{Film}', [FilmHandle::class,'index'])->name('film');

    Route::get('/promotion',[PromotionHandle::class,'index'])->name('promotion');

    Route::get('/member', [MemberHandle::class,'index'])->name('member');

    Route::get('/info/{Name}/{Day}',[InfoHandle::class,'index'])->name('info');

    Route::get('/infoComingFilm/{Name}', [ComingFilmInfoHandle::class,'index'])->name('comingFilmInfo');

});

//Admin router 
Route::prefix('admin')->middleware(CheckPermission::class)->group(function () {
    Route::get('/', [AdminHomeHandle::class,'index'])->name('adminHome');
    Route::delete('/', [AdminHomeHandle::class,'deleteFilm']);

    Route::get('/film/{Film}', [AdminFilmHandle::class,'index'])->name('adminFilm');
    Route::delete('/film/{Film}', [AdminFilmHandle::class,'deleteFilm']);

    Route::get('/promotion', [AdminPromotionHandle::class,'index'])->name('adminPromotion');

    Route::get('/user/account', [AdminMemberHandle::class,'index'])->name('adminAccount');
    Route::get('/user/member', [AdminMemberHandle::class,'memberAdmin'])->name('adminMember');

    Route::get('/infoAdd/{Film}', [AdminInfoAdd::class,'index'])->name('adminInfoAdd');
    Route::post('/infoAdd/{Film}', [AdminInfoAdd::class,'addFilm']);

    Route::get('/infoEdit/{Name}/{Day}', [AdminInfoEdit::class,'index'])->name('adminInfoEdit');
    Route::post('/infoEdit/{Name}/{Day}', [AdminInfoEdit::class,'infoEdit']);

    Route::get('/infoComingFilmEdit/{Name}', [AdminComingFilmInfoEdit::class,'index'])->name('adminComingFilmInfoEdit');
    Route::post('/infoComingFilmEdit/{Name}', [AdminComingFilmInfoEdit::class,'infoEdit']);
});