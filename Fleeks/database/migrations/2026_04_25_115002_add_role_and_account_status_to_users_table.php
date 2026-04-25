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
        if (! Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role', 20)->default('user')->after('password');
            });
        }

        if (! Schema::hasColumn('users', 'account_status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('account_status', 20)->default('pending')->after('role');
            });
        }

        // Index is intentionally omitted here to keep this migration safe to run on
        // databases where the columns and/or index may already exist.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'account_status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('account_status');
            });
        }

        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};
