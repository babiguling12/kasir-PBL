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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->decimal('total_bayar');
            $table->decimal('jumlah_uang');
            $table->decimal('diskon')->default(0);
            $table->string('nota');
            $table->foreignId('kasir_id')->constrained(
                table: 'pengguna',
                indexName: 'transaksi__kasir_id_foreign'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->enum('metode_pembayaran', ['cash', 'transfer']);
            $table->string('snap_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_');
    }
};
