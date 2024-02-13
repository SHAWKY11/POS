<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProductController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('can:read_product' )->only('index');
        $this->middleware('can:create_product')->only('create');
        $this->middleware('can:update_product')->only(['update','edit']);
        $this->middleware('can:delete_product')->only('destroy');
    }
    
    public function index(Request $request)
    {
        $products = Product::when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->latest()->paginate(5);
        $categories=Category::all();
        return view('dashboard.products.index',compact('products','categories'));

    }//end of index

    
    public function create()
    {
        $categories=Category::all();
        return view('dashboard.products.create',compact('categories'));
    }//end of create

    
    public function store(Request $request)
    {
        $request->validate([
            'category_id'=>'required',
            'name'=>'required|unique:products,name',
            'description'=>'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);
        $input = $request->all();
        if($request->file('image')){
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->resize(215,215);
            $image->save(public_path('uploads/product_images/' .$request->file('image')->hashName()));
           
            $input['image']= $request->image->hashName();
        }//End of if
        Product::create($input);
        return redirect('products');
        session()->flash('success','added_successfully');

    }//end of store

    public function show(Product $product)
    {
        //
    }//end of show

    
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit',compact('product','categories'));
    }//end of edit

    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'=>'required',
            'name'=>'required|unique:products,name,'.$product->id,
            'description'=>'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);
        $input = $request->all();
        if($request->file('image')){
            if($product->image !='default.png')
            {
                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
            }
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->resize(215,215);
            $image->save(public_path('uploads/product_images/' .$request->file('image')->hashName()));
            $input['image']= $request->image->hashName();
        }//End of if
        $product->update($input);
        return redirect('products');
        session()->flash('success','added_successfully');
    }//end of update

    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('products');
        session()->flash('success','added_successfully');
    }//end of destroy
}
