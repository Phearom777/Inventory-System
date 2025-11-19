<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Customers;
use App\Models\Purchases;
use App\Models\Sales;

class DashboardController extends Controller
{
   public function totalCount()
    {
        $totalCategories = Category::count();
        $totalProducts = Products::count();
        $totalCustomers = Customers::count();
        $totalSupplier = Suppliers::count();
        $totalPurchases = Purchases::count();
        $totalSale = Sales::count();
        $totalRevenue = Sales::sum('total_amount'); // Add this line

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalCustomers','totalSupplier','totalPurchases','totalSale','totalRevenue'));
    }
}