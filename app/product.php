<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    // كود خاص بارسال البيانات الي قواعد البيانات 

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

    //IDكود خاص باظهار الفئات باسمها بدلا من ظهور ال
    function cat()
    {
        return $this->belongsTo('App\category', 'category_id');
    }
}
