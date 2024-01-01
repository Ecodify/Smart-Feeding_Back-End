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
        Schema::create('devices_sensors', function (Blueprint $table) {
            $table->id();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->string('day')->nullable();
            $table->string('timestamp')->nullable();
            $table->string('temperature');
            $table->string('humidity');
            $table->string('ammonia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices_sensors');
    }
};
