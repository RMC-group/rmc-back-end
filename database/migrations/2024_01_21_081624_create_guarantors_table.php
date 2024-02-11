<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guarantors', function (Blueprint $table) {
            $table->increments('guarantor_id');
            $table->string('fist_name');
            $table->string('last_name');
            $table->string('cust_contact');
            $table->string('nic');
            $table->string('emill')->default('null');
            $table->string('front_image')->default('null');
            $table->string('back_image')->default('null');
            $table->unsignedInteger('cust_id')->index();
            $table->foreign('cust_id')->references('cust_id')->on('customer')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('guarantors');
    }
};
