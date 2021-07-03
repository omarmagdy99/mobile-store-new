<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_details', function (Blueprint $table) {
            //unsignedBigIntegerحقل من نوع 
            //Auto incrementلا يقبل القيم السالبة و 
            //عدد الخانات المسموح بها 20
            $table->id();
            // ========================

            // لا يقبل القيم السالبة
            //عدد الخانات المسموح بها 20
            $table->unsignedBigInteger('sales_invoice_id');
            $table->unsignedBigInteger('product_id');
            // ==========================
            $table->integer('quantity');

            //حقول تقبل كسور
            $table->double('price');
            $table->double('total');
            // =========================
            //حقل الخاص ب وضع التاريخ و التوقيت الحالي في الجدول
            $table->timestamps();
            //سطرين خاصيين بتعريف المفتاح الخارجي
            $table->foreign('sales_invoice_id')->references('id')->on('sales_invoices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_invoice_details');
    }
}
