<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    public function home() {

        $categories = Category::count();
        $products = Product::count();
        $clients = Client::count();
        $users = User::count();

        $salesData = Order::select(
            DB::raw('YEAR(created_at) AS year'),
            DB::raw('MONTH(created_at) As month'),
            DB::raw('SUM(total_price) as total_price'),
        )
            ->groupBy('month')
            ->get();
            $month = $salesData->pluck('month')->all();
            $totalPrice = $salesData->pluck('total_price')->all();

        return view('dashboard/home', compact('categories', 'products', 'clients', 'users', 'month', 'totalPrice'));
    }
}
