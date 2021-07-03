<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesInvoicesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_invoices_details', function (Blueprint $table) {
            //unsignedBigIntegerحقل من نوع 
            //Auto incrementلا يقبل القيم السالبة و 
            //عدد الخانات المسموح بها 20
            $table->id();
            // ========================

            // لا يقبل القيم السالبة
            //عدد الخانات المسموح بها 20
            $table->unsignedBigInteger('invoice_id');

            $table->string('product_name');

            $table->integer('quantity');
            //========================
            //حقول تقبل كسور
            $table->double('price');
            $table->double('total');

            $table->foreign('invoice_id')->references('id')->on('purchases_invoices')->onDelete('cascade');
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
        Schema::dropIfExists('purchases_invoices_details');
    }
}
