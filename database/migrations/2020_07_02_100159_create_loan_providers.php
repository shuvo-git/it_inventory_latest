<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            $table->string('mobile_no',20)->nullable()->unique();
            $table->string('address',191)->nullable();
            $table->double('loan_amount',10,2)->default(0);
            $table->double('loan_paid',10,2)->default(0);
            $table->double('loan_remain',10,2)->default(0);
            $table->tinyInteger('status')->default(1)->comment('1=loan raning,0=loan close');
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
        Schema::dropIfExists('loan_providers');
    }
}
