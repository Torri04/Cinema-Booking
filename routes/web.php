<?php

//Admin Controllers
use App\Http\Controllers\admin\AdminBookingHandle;
use App\Http\Controllers\admin\AdminComingFilmInfoEdit;
use App\Http\Controllers\admin\AdminFilmHandle;
use App\Http\Controllers\admin\AdminInfoAdd;
use App\Http\Controllers\admin\AdminInfoEdit;
use App\Http\Controllers\admin\AdminPromotionHandle;
use App\Http\Controllers\admin\AdminHomeHandle;
use App\Http\Controllers\admin\AdminMemberHandle;


//User Controllers
use App\Http\Controllers\user\MemberHandle;
use App\Http\Controllers\user\ComingFilmInfoHandle;
use App\Http\Controllers\user\HomeHandle;
use App\Http\Controllers\user\FilmHandle;
use App\Http\Controllers\user\PromotionHandle;
use App\Http\Controllers\user\InfoHandle;
use App\Http\Controllers\user\BookingHandle;

//#
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignInHandle;
use App\Http\Controllers\SignOutHandle;
use App\Http\Controllers\SignUpHandle;
use App\Http\Controllers\PaymentController;

//Middleware
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\CheckUser;



//Sign In Router
Route::get('/signin', [SignInHandle::class, 'index'])->name('signin');

Route::post('/signin', [SignInHandle::class, 'SignInHandle']);

////Sign Up Router
Route::get('/signup', [SignUpHandle::class, 'index'])->name('signup');

Route::post('/signup', [SignUpHandle::class, 'SignUpHandle']);

//Sign Out Router
Route::get('/signout', [SignOutHandle::class, 'index'])->name('signout');

//User Router
Route::prefix('/')->middleware(CheckUser::class)->group(function () {
    Route::get('/', [HomeHandle::class, 'index'])->name('home');

    Route::get('/film/{Film}', [FilmHandle::class, 'index'])->name('film');

    Route::get('/booking/{ShowID}', [BookingHandle::class, 'index'])->name('booking');
    Route::post('/booking/{ShowID}', [BookingHandle::class, 'paymentHandle']);

    Route::get('/promotion', [PromotionHandle::class, 'index'])->name('promotion');

    Route::get('/user/account', [MemberHandle::class, 'index'])->name('userAccount');
    Route::post('/user/account', [MemberHandle::class, 'accountEdit']);

    Route::get('/user/member', [MemberHandle::class, 'memberUser'])->name('userMember');

    Route::get('/info/{Name}/{Day}', [InfoHandle::class, 'index'])->name('info');

    Route::get('/infoComingFilm/{Name}', [ComingFilmInfoHandle::class, 'index'])->name('comingFilmInfo');
});

//Admin router 
Route::prefix('admin')->middleware(CheckPermission::class)->group(function () {
    Route::get('/', [AdminHomeHandle::class, 'index'])->name('adminHome');
    Route::delete('/', [AdminHomeHandle::class, 'deleteFilm']);

    Route::get('/film/{Film}', [AdminFilmHandle::class, 'index'])->name('adminFilm');
    Route::delete('/film/{Film}', [AdminFilmHandle::class, 'deleteFilm']);

    Route::get('/promotion', [AdminPromotionHandle::class, 'index'])->name('adminPromotion');

    Route::get('/user/account', [AdminMemberHandle::class, 'index'])->name('adminAccount');
    Route::post('/user/account', [AdminMemberHandle::class, 'accountEdit']);

    Route::get('/user/member', [AdminMemberHandle::class, 'memberAdmin'])->name('adminMember');

    Route::get('/infoAdd/{Film}', [AdminInfoAdd::class, 'index'])->name('adminInfoAdd');
    Route::post('/infoAdd/{Film}', [AdminInfoAdd::class, 'addFilm']);

    Route::get('/booking/{ShowID}', [AdminBookingHandle::class, 'index'])->name('adminBooking');
    Route::post('/booking/{ShowID}', [AdminBookingHandle::class, 'paymentHandle']);

    Route::get('/infoEdit/{Name}/{Day}', [AdminInfoEdit::class, 'index'])->name('adminInfoEdit');
    Route::post('/infoEdit/{Name}/{Day}', [AdminInfoEdit::class, 'infoEdit']);

    Route::get('/infoComingFilmEdit/{Name}', [AdminComingFilmInfoEdit::class, 'index'])->name('adminComingFilmInfoEdit');
    Route::post('/infoComingFilmEdit/{Name}', [AdminComingFilmInfoEdit::class, 'infoEdit']);
});
//Thanh toán
Route::post('/vn_payment', [PaymentController::class, 'vnpayment']);
Route::get('/return', [PaymentController::class, 'index']);
