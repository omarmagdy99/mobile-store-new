<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable=[
        'barcode',
        'product_name',
        'brand_id',
        'category_id',
        'image',
        'purchase_price',
        'sale_price',
        'quantity',
    ];
}