<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_publiks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_order')->unique();
            $table->string('nama_customer');
            $table->string('telepon')->nullable();
            $table->text('catatan')->nullable();
            $table->decimal('total', 15, 2)->default(0);
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'batal'])->default('menunggu');
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('order_publik_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_publik_id')->constrained('order_publiks')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('harga', 15, 2);
            $table->decimal('subtotal', 15, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_publik_details');
        Schema::dropIfExists('order_publiks');
    }
};
