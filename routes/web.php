<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('backend.auth.login');
// });
Route::get('/dashboard', function () {
    return view('backend.dashboard.super_admin');
});

// Authentication
Route::get('/create', [AuthController::class, 'index'])->name('registration');
Route::post('/register', [AuthController::class, 'registration'])->name('register');
Route::get('/', [AuthController::class, 'create'])->name('login');
Route::post('/login/store', [AuthController::class, 'login'])->name('login.store');
Route::get('/forget', [AuthController::class, 'forgot'])->name('forgot');

// Writer
Route::get('/lekhok', [WriterController::class, 'index'])->name('lekhok.index');
Route::get('/lekhok/create', [WriterController::class, 'create'])->name('lekhok.create');
Route::post('/lekhok/store', [WriterController::class, 'store'])->name('lekhok.store');
Route::get('/lekhok/edit/{id}', [WriterController::class, 'edit'])->name('lekhok.edit');
Route::post('/lekhok/update/{id}', [WriterController::class, 'update'])->name('lekhok.update');
Route::get('/lekhok/delete/{id}', [WriterController::class, 'destroy'])->name('lekhok.delete');

// category
Route::get('/category', [CategoryController::class, 'index'])->name('categories');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

// book
Route::get('/boi', [BookController::class, 'index'])->name('boi');
Route::get('/boi/create', [BookController::class, 'create'])->name('boi.create');
Route::post('/boi/store', [BookController::class, 'store'])->name('boi.store');
Route::get('/boi/edit/{id}', [BookController::class, 'edit'])->name('boi.edit');
Route::post('/boi/update/{id}', [BookController::class, 'update'])->name('boi.update');
Route::get('/boi/delete/{id}', [BookController::class, 'destroy'])->name('boi.delete');

// Stock
Route::get('/store', [StockController::class, 'index'])->name('stocks');
Route::get('/store/create', [StockController::class, 'create'])->name('store.create');
Route::post('/stock/store', [StockController::class, 'restock'])->name('store.restock');
Route::get('/stock_detail', [StockController::class, 'in_stock'])->name('stockDetails');
// Route::get('/boi/edit/{id}', [BookController::class, 'edit'])->name('boi.edit');
// Route::post('/boi/update/{id}', [BookController::class, 'update'])->name('boi.update');
// Route::get('/boi/delete/{id}', [BookController::class, 'destroy'])->name('boi.delete');

// customer
Route::get('/Customer', [CustomerController::class, 'index'])->name('customers');
Route::get('/Customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/Customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
Route::post('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
Route::get('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');

// Transaction or Sales
Route::get('/transaction', [TransactionController::class, 'index'])->name('transactions.index');

Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');

Route::get('/books/search', [TransactionController::class, 'searchBooks'])->name('books.search');

Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');

// Pos Interface
Route::get('/pos', function () {
    return view('backend.sale.pos_application');
});
Route::get('/search', function () {
    return view('backend.sale.search_dropdwon');
});
