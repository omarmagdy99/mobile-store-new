<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales_invoice_details extends Model
{    // كود خاص بارسال البيانات الي قواعد البيانات 

    protected $guarded = [];

    
    function productName()
    {
        return $this->belongsTo('App\product', 'product_id');
    }
}
