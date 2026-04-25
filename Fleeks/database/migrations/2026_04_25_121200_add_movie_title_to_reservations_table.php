<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('reservations') || Schema::hasColumn('reservations', 'movie_title')) {
            return;
        }

        Schema::table('reservations', function (Blueprint $table) {
            $table->string('movie_title')->after('room_id');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('reservations') || ! Schema::hasColumn('reservations', 'movie_title')) {
            return;
        }

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('movie_title');
        });
    }
};

