<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // meeting_bookings anpassen
        Schema::table('meeting_bookings', function (Blueprint $table) {
            $table->enum('mode', ['online', 'praesenz'])->after('type')->nullable();
            $table->enum('type', ['beratung', 'angebot', 'hausanschluss', 'projektplanung'])->change();
        });

        // pending_bookings anpassen
        Schema::table('pending_bookings', function (Blueprint $table) {
            $table->enum('mode', ['online', 'praesenz'])->after('type')->nullable();
            $table->enum('type', ['beratung', 'angebot', 'hausanschluss', 'projektplanung'])->change();
        });
    }

    public function down(): void
    {
        // Revert: mode-Spalte entfernen
        Schema::table('meeting_bookings', function (Blueprint $table) {
            $table->dropColumn('mode');
            $table->enum('type', ['online', 'praesenz'])->change(); // ursprüngliche Typen
        });

        Schema::table('pending_bookings', function (Blueprint $table) {
            $table->dropColumn('mode');
            $table->enum('type', ['online', 'praesenz'])->change();
        });
    }
};
