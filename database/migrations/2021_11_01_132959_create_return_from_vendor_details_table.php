<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnFromVendorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_from_vendor_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('return_from_vendor_id');
            $table->unsignedBigInteger('stockin_id');
            $table->tinyInteger('condition');
            $table->string('remarks');
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
        Schema::dropIfExists('return_from_vendor_details');
    }
}
