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
        Schema::create('stok_masuk', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('barcode_id')->constrained(
                table: 'produk',
                indexName: 'stok_masuk_barcode_id_foreign'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('supplier_id')->constrained(
                table: 'supplier',
                indexName: 'stok_masuk_supplier_id_foreign'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_masuk');
    }
};
