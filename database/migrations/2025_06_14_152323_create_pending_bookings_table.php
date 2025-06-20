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
        Schema::create('pending_bookings', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['beratung', 'angebot', 'hausanschluss', 'projektplanung']);
            $table->enum('mode', ['online', 'praesenz']);
            $table->timestamp('start');
            $table->timestamp('end');
            $table->string('name');
            $table->string('email');
            $table->string('topic')->nullable();
            $table->string('token')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_bookings');
    }
};
