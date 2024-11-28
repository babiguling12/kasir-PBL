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
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained(
                table: 'transaksi',
                indexName: 'transaksi_detail_transaksi_id_foreign'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->integer('qty');
            $table->decimal('total_harga_barang');
            $table->foreignId('barcode_id')->constrained(
                table: 'produk',
                indexName: 'transaksi_detail_barcode_id_foreign'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_detail');
    }
};
