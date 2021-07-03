<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            //unsignedBigIntegerحقل من نوع 
            //Auto incrementلا يقبل القيم السالبة و 
            //عدد الخانات المسموح بها 20
            $table->id();

            $table->string('name');

            //حقل يقل نصوص واقصي عدد خانات له11
            $table->string('phone', 11);
            
            //حقل الخاص ب وضع التاريخ و التوقيت الحالي في الجدول
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
