<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Client;
use App\Models\User;

class DashboardController extends Controller
{
    //

    public function home() {

        $categories = Category::count();
        $products = Product::count();
        $clients = Client::count();
        $users = User::count();

        return view('dashboard/home', compact('categories', 'products', 'clients', 'users'));
    }
}
