<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Cabang
        Schema::create('cabangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cabang')->unique();
            $table->string('nama_cabang');
            $table->text('alamat');
            $table->string('telepon', 20);
            $table->string('email', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel Stok per Cabang
        Schema::create('stok_cabangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabang_id')->constrained('cabangs')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->integer('stok')->default(0);
            $table->timestamps();
            
            // Unique constraint: satu produk hanya punya satu record stok per cabang
            $table->unique(['cabang_id', 'produk_id']);
        });

        // Update tabel transaksi: tambah cabang_id
        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->after('id')->constrained('cabangs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['cabang_id']);
            $table->dropColumn('cabang_id');
        });
        
        Schema::dropIfExists('stok_cabangs');
        Schema::dropIfExists('cabangs');
    }
};
