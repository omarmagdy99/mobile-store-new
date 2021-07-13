<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchases_invoice extends Model
{
    // كود خاص بارسال البيانات الي قواعد البيانات 
    protected $guarded = [];

    // الخاص بهIDكودين خاصيين باظهار اسم المستخدم واسم المورد بلاد من ظهور رقم 
    function usersName()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    function supplierName()
    {
        return $this->belongsTo('App\supplier', 'supplier_id');
    }
}
