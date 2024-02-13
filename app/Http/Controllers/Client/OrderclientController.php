<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Client;

class OrderclientController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create(Client $client)
    {
        $product=Product::with('category')->get();
        $orders = $client->orders()->with('products')->get();
        $categories=Category::with('product')->get();
        return view('dashboard.clients.orders.create',compact('categories','orders','client'));
    }

    
    public function store(Request $request,Client $client)
    {
        // dd($request->all());
        $request->validate([
            'products' => 'required|array',
        ]);
        $this->attach_order($request, $client);
        return redirect()->route('orders.index');
    }

    
    public function show(string $id)
    {
        //
    }

    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);

        }//end of foreach

        $order->update([
            'total_price' => $total_price
        ]);

    }//end of attach order

    

    
    public function edit(Client $client,Order $order)
    {
        $categories = Category::with('product')->get();
        $orders=$client->orders()->with('products')->get();
        return view('dashboard.clients.orders.edit',compact('order','client','categories','orders'));
    }

    
    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);
        $this->detach_order($order);
        $this->attach_order($request, $client);
        return redirect()->route('orders.index');
    }

    
   private function detach_order($order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);

        }//end of for each

        $order->delete();

    }//end of detach order
}
