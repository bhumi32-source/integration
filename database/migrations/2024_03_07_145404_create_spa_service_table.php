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
        Schema::create('spa_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spa_package_id');
            $table->foreign('spa_package_id')->references('id')->on('spa_package');
            $table->unsignedBigInteger('spa_service_type_id');
            $table->foreign('spa_service_type_id')->references('id')->on('spa_service_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spa_service');
    }
};
