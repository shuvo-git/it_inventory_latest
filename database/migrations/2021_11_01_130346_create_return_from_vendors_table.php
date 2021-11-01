<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnFromVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_from_vendors', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('product');
            $table->string('delivery_person_name',50);
            $table->string('delivery_person_phn_no',11);
            $table->date('delivery_date');
            $table->string('remarks',300);
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
        Schema::dropIfExists('return_from_vendors');
    }
}
