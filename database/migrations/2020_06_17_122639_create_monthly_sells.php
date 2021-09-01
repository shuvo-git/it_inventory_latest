<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlySells extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_sells', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->string('year',10);
            $table->string('month',10);
            $table->double('total_sell',10,2);
            $table->double('total_profit',10,2);
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
        Schema::dropIfExists('monthly_sells');
    }
}
