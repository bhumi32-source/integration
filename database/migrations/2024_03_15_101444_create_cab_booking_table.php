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
        Schema::create('cab_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_order_id')->default(0);
            $table->string('trip_type', 50);
            $table->string('pickup_location', 255);
            $table->date('pickup_date');
            $table->string('pickup_time', 50)->default('');
            $table->string('drop_location', 255)->nullable();
            $table->integer('rental_hours')->nullable();
            $table->integer('no_of_persons')->nullable();
            $table->text('special_request')->nullable();
            $table->timestamps();
                
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cab_booking');
    }
};
