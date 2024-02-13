<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Client;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class WelcomeController extends Controller
{
    public function index()
    {
        $clients_count=Client::count();
        $orders_count=Order::count();
        $categories_count=Category::count();
        $products_count=Product::count();
        $users_count=User::count();

        $sales_data = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();
        return view('welcome',compact('users_count','products_count','orders_count','clients_count','categories_count','sales_data'));
    }
}
