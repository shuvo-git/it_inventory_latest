<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->integer('qty');
            $table->double('unit_price',10,2);
            $table->double('total_price',10,2);
            $table->double('discount',10,2);
            $table->double('returnable_amount',10,2);
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('return_items');
    }
}
