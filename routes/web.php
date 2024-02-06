<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [WelcomeController::class, 'Index'])->name('index');
Route::get('/about', [WelcomeController::class, 'About'])->name('about');
Route::get('/listing', [WelcomeController::class, 'Listing'])->name('listing');
Route::get('/contact', [WelcomeController::class, 'Contact'])->name('contact');
Route::post('/contact/submit', [WelcomeController::class, 'ContactSubmit'])->name('contact.submit');
Route::get('/blog', [WelcomeController::class, 'Blog'])->name('blog');
Route::get('/testimonial', [WelcomeController::class, 'Testimonial'])->name('testimonial');

//
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    //
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminAuthController::class, 'Login'])->name('login');
        Route::post('login/submit', [AdminAuthController::class, 'LoginSubmit'])->name('login.submit');
        Route::post('register/submit', [AdminAuthController::class, 'RegisterSubmit'])->name('register.submit');
    });

    //
    Route::middleware('auth')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'Logout'])->name('logout');

        //
        Route::get('home', [AdminHomeController::class, 'Home'])->name('home');
        Route::get('message/list', [AdminHomeController::class, 'MessageList'])->name('message.list');
        Route::get('message/{message}', [AdminHomeController::class, 'MessageShow'])->name('message.show');
        Route::get('message/active/{message}', [AdminHomeController::class, 'MessageActive'])->name('message.active');

        //
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/list', [UserController::class, 'list'])->name('list');
            Route::get('/add', [UserController::class, 'add'])->name('add');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
            Route::post('/update/{user}', [UserController::class, 'update'])->name('update');
            Route::get('/active/{user}', [UserController::class, 'active'])->name('active');
        });

        //
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/list', [CategoryController::class, 'list'])->name('list');
            Route::get('/add', [CategoryController::class, 'add'])->name('add');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('/update/{category}', [CategoryController::class, 'update'])->name('update');
            Route::get('/active/{category}', [CategoryController::class, 'active'])->name('active');
        });

        //
        Route::prefix('car')->name('car.')->group(function () {
            Route::get('/list', [CarController::class, 'list'])->name('list');
            Route::get('/add', [CarController::class, 'add'])->name('add');
            Route::post('/store', [CarController::class, 'store'])->name('store');
            Route::get('/edit/{car}', [CarController::class, 'edit'])->name('edit');
            Route::post('/update/{car}', [CarController::class, 'update'])->name('update');
            Route::get('/active/{car}', [CarController::class, 'active'])->name('active');
        });

        //
        Route::prefix('testimonial')->name('testimonial.')->group(function () {
            Route::get('/list', [TestimonialController::class, 'list'])->name('list');
            Route::get('/add', [TestimonialController::class, 'add'])->name('add');
            Route::post('/store', [TestimonialController::class, 'store'])->name('store');
            Route::get('/edit/{testimonial}', [TestimonialController::class, 'edit'])->name('edit');
            Route::post('/update/{testimonial}', [TestimonialController::class, 'update'])->name('update');
            Route::get('/active/{testimonial}', [TestimonialController::class, 'active'])->name('active');
        });
    });
});
