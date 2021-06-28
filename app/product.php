<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'barcode',
        'product_name',
        'brand_name',
        'category_id',
        'image',
        'purchase_price',
        'sale_price',
        'quantity',
    ];

    function cat(){
        return $this->belongsTo('App\category','category_id');
    }
}
