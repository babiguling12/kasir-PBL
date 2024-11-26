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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->unique();
            $table->string('nama_produk');
            $table->foreignId('kategori_id')->constrained(
                table: 'kategori_produk',
                indexName: 'produk_kategori_id_foreign'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('satuan_id')->constrained(
                table: 'satuan_produk',
                indexName: 'produk_satuan_produk_id_foreign'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->integer('harga');
            $table->integer('stok');
            $table->integer('terjual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
