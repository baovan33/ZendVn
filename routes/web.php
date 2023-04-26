<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;

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


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/dashboard',[DashboardController::class,'Dashboard'])->name('dashboard')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('role')->middleware('auth')->name('role.')->group(function () {

    Route::get('/', [RoleController::class, 'index'])->name('index')->middleware(['permission:show-role']);

    Route::get('/create', [RoleController::class, 'create'])->name('create')->middleware(['permission:create-role']);

    Route::post('/store', [RoleController::class, 'store'])->name('store')->middleware(['permission:create-role']);

    Route::get('/permission/{id}', [RoleController::class, 'permission'])->name('permission')->middleware(['permission:permission-role']);

    Route::post('/permission/{id}', [RoleController::class, 'PostPermission'])->name('PostPermission')->middleware(['permission:permission-role']);

    Route::get('/edit/{role}',[RoleController::class, 'edit'])->name('edit')->middleware(['permission:update-role']);

    Route::post('/edit/{role}',[RoleController::class, 'update'])->name('update')->middleware(['permission:update-role']);

    Route::get('/delete/{role}',[RoleController::class, 'delete'])->name('delete')->middleware(['permission:delete-role']);


});
Route::prefix('users')->middleware('auth')->name('users.')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('index')->middleware(['permission:show-user']);

    Route::get('/add', [UserController::class, 'create'])->name('create')->middleware(['permission:create-user']);

    Route::post('/add', [UserController::class, 'store'])->name('store')->middleware(['permission:create-user']);

    Route::get('/edit/{user}',[UserController::class, 'edit'])->name('edit')->middleware(['permission:update-user']);

    Route::post('/update/{user}',[UserController::class, 'update'])->name('update')->middleware(['permission:update-user']);

    Route::get('/delete/{user}',[UserController::class, 'delete'])->name('delete')->middleware(['permission:delete-user']);
});

Route::prefix('slider')->middleware('auth')->name('slider.')->group( function () {

    Route::get('/',[SliderController::class,'index'])->name('index')->middleware(['permission:show-slider']);

    Route::get('/create',[SliderController::class,'create'])->name('create')->middleware(['permission:create-slider']);

    Route::post('/create',[SliderController::class,'PostCreate'])->name('PostCreate')->middleware(['permission:create-slider']);

    Route::get('/edit/{slider}',[SliderController::class,'edit'])->name('edit')->middleware(['permission:update-slider']);

    Route::post('/update/{slider}',[SliderController::class,'update'])->name('update')->middleware(['permission:update-slider']);

    Route::get('/delete/{slider}',[SliderController::class,'delete'])->name('delete')->middleware(['permission:delete-slider']);


});

Route::prefix('category')->middleware('auth')->name('category.')->group( function () {

    Route::get('/',[CategoryController::class, 'index'])->name('index')->middleware(['permission:show-category']);

    Route::get('/create',[CategoryController::class, 'create'])->name('create')->middleware(['permission:create-category']);

    Route::post('/create',[CategoryController::class, 'postCreate'])->name('postCreate')->middleware(['permission:create-category']);

    Route::get('/edit/{category}',[CategoryController::class,'edit'])->name('edit')->middleware(['permission:update-category']);

    Route::post('/update/{category}',[CategoryController::class,'update'])->name('update')->middleware(['permission:update-category']);

    Route::get('/delete/{category}',[CategoryController::class,'delete'])->name('delete')->middleware(['permission:delete-category']);

});

Route::prefix('product')->middleware('auth')->name('product.')->group( function () {

    Route::get('/',[ProductController::class, 'index'])->name('index');

    Route::get('/create',[ProductController::class, 'create'])->name('create');

    Route::post('/create',[ProductController::class, 'postCreate'])->name('postCreate');

    Route::get('/edit/{product}',[ProductController::class,'edit'])->name('edit');

    Route::post('/update/{product}',[ProductController::class,'update'])->name('update');



});
