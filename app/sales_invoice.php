<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales_invoice extends Model
{
    protected $guarded=[];
    function usersName(){
        return $this->belongsTo('App\User','user_id');
    }
    function customerName(){
        return $this->belongsTo('App\customer','customer_id');
    }
}
