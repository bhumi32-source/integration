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
        Schema::create('extra_bed_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_order_id');
            $table->foreign('service_order_id')->references('id')->on("service_order");
            $table->unsignedBigInteger('rate_id');
            $table->foreign('rate_id')->references('id')->on("extra_bed_rate");
            $table->Integer( 'quantity' );
            $table->text('special_request');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_bed_order');
    }
};
