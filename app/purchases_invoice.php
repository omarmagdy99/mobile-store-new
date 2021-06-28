<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchases_invoice extends Model
{protected $guarded=[];
    function usersName(){
        return $this->belongsTo('App\User','user_id');
    }
    function supplierName(){
        return $this->belongsTo('App\supplier','supplier_id');
    }
}
