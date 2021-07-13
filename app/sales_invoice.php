<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales_invoice extends Model
{    // كود خاص بارسال البيانات الي قواعد البيانات 

    protected $guarded = [];
    function usersName()
    {
        // الخاص بهIDاحضار بيانات المستخدم ووضع اسمة مكان ال
        return $this->belongsTo('App\User', 'user_id');
    }
    function customerName()
    {
        // الخاص بهIDاحضار بيانات العميل ووضع اسمة مكان ال
        return $this->belongsTo('App\customer', 'customer_id');
    }
}
