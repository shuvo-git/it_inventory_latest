<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOreders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('customer_name')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->integer('number_of_product');
            $table->double('total_price',10,2);
            $table->double('discount',10,2);
            $table->double('grand_price',10,2);
            $table->double('profit',10,2)->default(0);
            $table->bigInteger('sell_by');
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
        Schema::dropIfExists('orders');
    }
}
