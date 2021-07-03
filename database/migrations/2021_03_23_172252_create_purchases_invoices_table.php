<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_invoices', function (Blueprint $table) {
            //unsignedBigIntegerحقل من نوع 
            //Auto incrementلا يقبل القيم السالبة و 
            //عدد الخانات المسموح بها 20
            $table->id();

            //حقل يقبل ارقام فقط
            $table->integer('sub_total');

            // ويمكن تركة فارغtext حقل من نوع 
            $table->text('notes')->nullable();
            // ==============================

            // لا يقبل القيم السالبة
            //عدد الخانات المسموح بها 20
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('user_id');
            // ===================

            //سطرين خاصيين بتعريف المفتاح الخارجي
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // ================

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
        Schema::dropIfExists('purchases_invoices');
    }
}
