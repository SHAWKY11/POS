<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $appends=['image_path','profit_percent'];

    public function category()
    {
        return $this->belongsTo(Category::class);

    } //end of function category

    public function orders()
    {
        return $this->belongsToMany(Order::class,'product_order');

    } //end of function orders

    public function getImagePathAttribute()
    {
        return asset ('/uploads/product_images/' . $this->image);

    }//end of get image path

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);

    }//end of get image path

}


