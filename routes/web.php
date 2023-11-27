<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::post('/check', [UserController::class, 'check'])->name('check');
});

Route::middleware(['auth', 'adminonly'])->group(function () {
    
    Route::get('/admin/home', 
    [AdminController::class, 'home'])
    ->name('admin.home');

    Route::post('/admin/logout', 
    [AdminController::class, 'logout'])
    ->name('admin.logout');

    Route::get('/admin/orders/{status}', 
    [AdminController::class, 'orders'])
    ->name('admin.orders');

    Route::put('/admin/orders/{status}/{order_id}', 
    [AdminController::class, 'updatestatus'])
    ->name('admin.updateorders');

    //CATEGORY ROUTES
    Route::post('/admin/storecategory', 
    [AdminController::class, 'storecategory'])
    ->name('admin.storecategory');

    Route::put('/admin/{category_id}/update', 
    [AdminController::class, 'updatecategory'])
    ->name('admin.updatecategory');

    Route::delete('/admin/{category_id}/delete', 
    [AdminController::class, 'deletecategory'])
    ->name('admin.deletecategory');

    Route::get('/admin/{category}', 
    [AdminController::class, 'category'])
    ->name('admin.category');
    

    //PRODUCTS ROUTES
    Route::post('/admin/{category}/storeproduct', 
    [AdminController::class, 'storeproduct'])
    ->name('admin.storeproduct');

    Route::put('/admin/{category}/{product_id}', 
    [AdminController::class, 'updateproduct'])
    ->name('admin.updateproduct');

    Route::put('/admin/markbestseller/{category}/{product_id}', 
    [AdminController::class, 'markbestseller'])
    ->name('admin.markbestseller');

    Route::get('/admin/{category}/addproduct', 
    [AdminController::class, 'addproduct'])
    ->name('admin.addproduct');

    Route::get('/admin/{category}/{product_id}', 
    [AdminController::class, 'viewproduct'])
    ->name('admin.viewproduct');

    Route::delete('/admin/{category}/{product_id}', 
    [AdminController::class, 'deleteproduct'])
    ->name('admin.deleteproduct');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [CustomerController::class,'home'])->name('customer.home');
    Route::post('/logout', [CustomerController::class,'logout'])->name('customer.logout');
    Route::put('/myorders/{order_id}', [CustomerController::class,'cancelorder'])->name('customer.cancelorder');
    Route::get('/myorders/{view}', [CustomerController::class,'myorders'])->name('customer.myorders');
    Route::get('/{category}', [CustomerController::class,'category'])->name('customer.category');
    Route::get('/{category}/{product_id}',[CustomerController::class, 'viewproduct'])->name('customer.viewproduct');
    Route::post('/{category}/{product_id}/{user_id}',[CustomerController::class, 'buyproduct'])->name('customer.buyproduct');
});

