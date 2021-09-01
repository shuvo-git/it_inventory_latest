<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('companies_id');
            $table->bigInteger('category_id');
            $table->string('name');
            $table->integer('buy_qty')->default(0)->comment('piece');
            $table->integer('sell_qty')->default(0)->comment('piece');
            $table->integer('available_qty')->default(0)->comment('piece');
            $table->double('buy_price',10,2)->default(0.00)->comment('per pice');
            $table->double('sell_price',10,2)->default(0.00)->comment('per pice');
            $table->string('group')->nullable();
            $table->string('details')->nullable();
            $table->integer('short_list_qty')->nullable();
            $table->date('exp_date')->nullable();
            $table->integer('status')->default(1)->comment('1 = available 0= unavailable');
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('products');
    }
}
