<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            //unsignedBigIntegerحقل من نوع 
            //Auto incrementلا يقبل القيم السالبة و 
            //عدد الخانات المسموح بها 20
            $table->id();

            //حقول تقبل نصوص
            $table->string('barcode');
            $table->string('product_name');

            //حقل يقبل ارقام فقط
            $table->integer('quantity');
            $table->string('image');

            $table->integer('sale_price');

            $table->string('brand_name');

            //عدد الخانات المسموح بها 20
            $table->unsignedBigInteger('category_id');
            //حقل الخاص ب وضع التاريخ و التوقيت الحالي في الجدول

            $table->timestamps();
            //السطر الخاص بتعريف المفتاح الخارجي للجدول

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            //onDelete Cascade 
            //  متعلق بهForeignKeyعند مسح المفتاح الرئيسي يمسح كل 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
