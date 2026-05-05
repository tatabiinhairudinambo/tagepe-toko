<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->enum('status', ['aktif', 'pending'])->default('aktif')->after('deskripsi');
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->onDelete('set null')->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign(['dibuat_oleh']);
            $table->dropColumn(['status', 'dibuat_oleh']);
        });
    }
};
