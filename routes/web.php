<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\RetrievesController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TotalOrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store']);
Route::post('/', [AuthController::class, 'destroy'])->name('logout');
Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');
Route::get('/addadmin', [AdminController::class, 'create'])->name('newadmin')->middleware('auth');
Route::post('/addadmin', [AdminController::class, 'store']);
Route::get('/admin/{admin}/edit', [AdminController::class, 'edit'])->middleware('auth');
Route::patch('/admin/{admin}', [AdminController::class, 'update']);
Route::delete('/admin/{admin}', [AdminController::class, 'destroy']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/add', [DashboardController::class, 'create'])->middleware('auth');
Route::post('/add', [DashboardController::class, 'store'])->name('add.store');
Route::get('/dashboard/{product}/edit',[DashboardController::class, 'edit'])->middleware('auth');
Route::patch('/dashboard/{id}', [DashboardController::class, 'update']);
Route::delete('/dashboard/{product}', [DashboardController::class, 'destroy']);

Route::get('/category', [CategoryController::class, 'index'])->middleware('auth');
Route::get('/addcategory', [CategoryController::class, 'create'])->middleware('auth');
Route::post('/addcategory', [CategoryController::class, 'store'])->middleware('auth');
Route::get('/category/{category}/edit',   [CategoryController::class, 'edit'])->middleware('auth');
Route::patch('/category/{category}', [CategoryController::class, 'update'])->name('cate');
Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category');

Route::get('/order',    [OrderController::class, 'create'])->name('order')->middleware('auth');
Route::get('/allorder', [OrderController::class, 'index'])->name('order')->middleware('auth');
Route::post('/order',   [OrderController::class, 'store'])->name('add-order');

Route::get('/display',  [OrderDetailsController::class, 'create'])->middleware('auth');
Route::post('/display', [OrderDetailsController::class, 'store'])->name('buy-order');
Route::delete('/order/{order}', [OrderDetailsController::class, 'destroy'])->name('delete-order');

Route::get('/show/{order}', [TotalOrderController::class, 'show'])->name('show-order');


Route::get('/replace/{order}', [TotalOrderController::class, 'replace'])->name('replace-order-show');
Route::post('/replace/{id}', [TotalOrderController::class, 'update'])->name('replace-order');




Route::delete('/allorder/{order}', [TotalOrderController::class, 'destroy'])->name('retrieve-order');
Route::get('/retrieve', [RetrievesController::class, 'show'])->name('retrieve')->middleware('auth');
Route::get('/users', [UserController::class, 'show'])->name('user')->middleware('auth');
Route::get('/adduser', [UserController::class, 'index'])->name('display-add-user')->middleware('auth');
Route::post('/adduser', [UserController::class, 'store'])->name('add-user');
Route::get('/edituser/{id}', [UserController::class, 'edit'])->name('edit-user')->middleware('auth');
Route::put('/users/{id}', [UserController::class, 'update'])->name('update-user');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('delete-user');

Route::get('/supplier', [SupplierController::class, 'index'])->middleware('auth')->name('supplier');
Route::get('/add-supplier', [SupplierController::class, 'create'])->middleware('auth')->name('display-add-supplier');
Route::post('/add-supplier', [SupplierController::class, 'store'])->middleware('auth')->name('add-supplier');
Route::get('/edit-supplier/{id}', [SupplierController::class, 'edit'])->middleware('auth')->name('display-edit-supplier');
Route::put('/edit-supplier/{id}', [SupplierController::class, 'update'])->middleware('auth')->name('edit-supplier');
Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('delete-supplier');

Route::get('/store', [StoreController::class, 'index'])->middleware('auth')->name('store');
Route::get('/add-store', [StoreController::class, 'create'])->middleware('auth')->name('add-store');
Route::get('/show-store/{id}', [StoreController::class, 'show'])->middleware('auth')->name('show-store');
Route::post('/add-store', [StoreController::class, 'store'])->middleware('auth')->name('store-new-store');

Route::get('/product-price/{id}', [OrderController::class, 'getPrice'])->name('get-price');
Route::get('/get-price/{id}', [OrderController::class, 'getPrice'])->name('get-price');
Route::get('/get-amount/{id}', [OrderController::class, 'getAmount'])->name('get-amount');
Route::get('/get-products-by-store/{store}', [OrderController::class, 'getByStoreJson']);

Route::get("/test", function () {
    return Hash::make("123456");
});
