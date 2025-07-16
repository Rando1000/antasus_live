<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('email_campaigns', function (Blueprint $table) {
            $table->uuid('tracking_token')->unique()->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->json('clicked_links')->nullable();
        });
    }
    public function down() {
        Schema::table('email_campaigns', function (Blueprint $table) {
            $table->dropColumn(['tracking_token', 'opened_at', 'clicked_links']);
        });
    }
};
