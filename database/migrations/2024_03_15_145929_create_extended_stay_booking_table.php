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
        Schema::create('extended_stay_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_order_id');
            $table->foreign('service_order_id')->references('id')->on('service_order');
            $table->enum('type_of_stay',['extend','modify']);
            $table->date('extend_till_date');
            $table->Interger('no_of_rooms');
            $table->Integer('no_of_guests');
            $table->enum('guests_are',['In Total','Per Room'])->nullable();
            $table->text('special_request');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extended_stay_booking');
    }
};
