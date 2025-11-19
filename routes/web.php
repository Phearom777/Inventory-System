<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductSupplierController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SuppliersController;

Route::get('/auth/redirect', [GoogleController::class, 'redirect']);
Route::get('/auth/callback', [GoogleController::class, 'callback']);
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/sale', function () {
    return view('admin.sale');
});

Route::get('/invoice', function () {
    return view('admin.invoice.invoice');
});

Route::get('/purchese', function () {
    return view('admin.purchase');
});
Route::get('/report', function () {
    return view('admin.report');
});

// register and login routes
Route::post('/register', [UsersController::class, 'register']);
Route::post('/login', [UsersController::class, 'login']);
Route::get('/logout', [UsersController::class, 'signOut']);

// dashboard
Route::get('/', [DashboardController::class, 'totalCount']);

// category routes
Route::get('/category', [CategoryController::class, 'category_list']);
Route::post('/addcategory', [CategoryController::class, 'create']);
Route::post('/deletecategory', [CategoryController::class, 'delete_category']);
Route::post('/updatecategory', [CategoryController::class, 'update_category']);

// product routes
Route::get('/product', [ProductsController::class, 'product_list']);
Route::post('/addproduct', [ProductsController::class, 'add_product']);
Route::post('/deleteproduct', [ProductsController::class, 'delete_product']);
Route::get('/edit_product/{id}', [ProductsController::class, 'edit_product']);
Route::post('/update_product', [ProductsController::class, 'update_product']);

// customer
Route::get('/customer', [CustomersController::class, 'customer_list']);
Route::post('/addcustomer', [CustomersController::class, 'addcustomer']);
Route::post('/deletecustomer', [CustomersController::class, 'delete_customer']);
Route::post('/updatecustomer', [CustomersController::class, 'update_customer']);

// supplier
Route::get('/supplier', [SuppliersController::class, 'supplier_list']);
Route::post('/addsupplier', [SuppliersController::class, 'addsupplier']);
Route::post('/deletesupplier', [SuppliersController::class, 'delete_supplier']);
Route::post('/updatesupplier', [SuppliersController::class, 'update_supplier']);

// purchase
Route::get('/purchese', [PurchasesController::class, 'purchase_list']);
Route::post('/addpurchase', [PurchasesController::class, 'addpurchase']);
Route::post('/delete_purchase', [PurchasesController::class, 'delete_purchase']);
Route::post('/update_purchase', [PurchasesController::class, 'update_purchase']);

// sale
Route::get('/sale', [SalesController::class, 'sale_list']);
Route::post('/addsale', [SalesController::class, 'addsale']);
Route::post('/delete_sale', [SalesController::class, 'delete_sale']);
Route::post('/editsale', [SalesController::class, 'editSale'])->name('sale.edit');
// Route::post('/update_sale', [SalesController::class, 'update_sale']);


Route::get('/product-suppliers', [ProductSupplierController::class, 'index']);
Route::get('/invoice-list', [InvoicesController::class, 'invoiceList']);


// Route::get('/sales/{id}/invoice', [SalesController::class, 'invoice'])->name('sales.invoice');
Route::get('/sales/{id}/print', [SalesController::class, 'print'])->name('sales.print');
