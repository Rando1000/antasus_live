<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('visitor_stats', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 256)->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->string('device_type', 16)->nullable();
            $table->string('browser', 64)->nullable();
            $table->string('os', 64)->nullable();
            $table->string('url', 255);
            $table->string('referer', 255)->nullable();
            $table->string('country', 128)->nullable();      // DE, NL, etc.
            $table->string('region', 256)->nullable();      // NRW, Berlin, North Holland
            $table->string('city', 128)->nullable();        // Stadtname
            $table->string('language', 32)->nullable();
            $table->timestamp('visited_at')->index();
        });

        // Optional: Sessions-Tabelle für weitere Tracking-Features
        Schema::create('visitor_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 256)->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('ip_address', 45)->nullable();
            $table->string('url', 255);
            $table->string('country', 2)->nullable();
            $table->string('region', 128)->nullable();
            $table->string('city', 128)->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitor_stats');
        Schema::dropIfExists('visitor_sessions');
    }
};
