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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_pembeli')->constrained('pembelis', 'id_pembeli')->onDelete('cascade');
            $table->date('tanggal_pesanan');
            $table->string('alamat_pengiriman');
            $table->string('no_telpon', 20);
            $table->string('nama_pembeli', 100);
            $table->decimal('total_tagihan', 15, 2)->default(0);
            $table->string('status_pesanan', 30)->default('menunggu');
            $table->text('catatan')->nullable();
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
