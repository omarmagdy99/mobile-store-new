<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //خاص بارسال البيانات الي قاعدة البيانات
    protected $fillable = [
        'category_name'
    ];
}
