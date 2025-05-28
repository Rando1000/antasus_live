<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('referenzes', function (Blueprint $table) {
            $table->json('bilder')->change();
        });
    }

    public function down(): void {
        Schema::table('referenzes', function (Blueprint $table) {
            $table->text('bilder')->change(); // optional fallback
        });
    }
};
