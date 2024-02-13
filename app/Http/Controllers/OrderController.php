<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders=Order::all();
        return view('dashboard.orders.index',compact('orders'));
    }

    public function products(Order $order)
    {
        $products=$order->products;
        return view('dashboard.orders._products',compact('products','order'));
    }

    public function destroy(Order $order)
    {
        foreach($order->products as $product){
            $product->update([
                'stock'=>$product->stock+$product->pivot->quantity,  //restaber el stock del producto en la tabla pivot
            ]);
        }
        $order->delete();
        return redirect('orders');
    }
}
