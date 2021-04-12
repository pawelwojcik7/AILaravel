<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TrainingRegistryController;
use App\Http\Controllers\myOrdersController;
use App\Http\Controllers\AdminController;
Auth::routes();

Route::get('/adminPanel',[AdminController::class,'index'])->name('adminPanel');
Route::get('/deleted/{id}', [AdminController::class,'destroy'])->name('deleteOrder');

Route::get('/editAdmin/{id}', [AdminController::class,'edit'])->name('editAdmin');
Route::get('/updateAdmin/{id}', [AdminController::class,'update'])->name('updateAdmin');

Route::get('/',[PostsController::class,'index'])->name('/');
Route::get('/create',[PostsController::class,'create'])->name('create');
Route::post('/create',[PostsController::class,'store'])->name('store');

Route::get('/delete/{id}', [PostsController::class,'destroy'])->name('delete');

Route::get('/edit/{id}', [PostsController::class,'edit'])->name('edit');
Route::get('/update/{id}',[PostsController::class,'update'])->name('update');

Route::get('/rezerwacja', [TrainingRegistryController::class,'create'])->name('rezerwacja');
Route::post('/rezerwacja', [TrainingRegistryController::class,'store'])->name('storeOrder');

Route::get('/myOrders', [myOrdersController::class,'index'])->name('myOrders');
Route::get('/editOrder/{id}', [myOrdersController::class,'edit'])->name('editOrder');
Route::get('/uprawnienia/{status}/{id}', [AdminController::class,'uprawnienia'])->name('uprawnienia');
Route::get('/uzytkownicy', [AdminController::class,'uzytkownicy'])->name('uzytkownicy');
Route::get('{id}',[myOrdersController::class,'update'])->name('updateOrder');


