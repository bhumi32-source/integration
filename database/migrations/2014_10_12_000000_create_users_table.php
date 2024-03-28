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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references( 'id' )->on('room');
            $table->string('name');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->dateTime('check_in_datetime')->nullable();
            $table->dateTime('checked_out_datetime')->nullable();
            
            $table->unsignedBigInteger('user_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
