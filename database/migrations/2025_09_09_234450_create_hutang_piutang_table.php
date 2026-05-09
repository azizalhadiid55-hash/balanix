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
        Schema::create('hutang_piutang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_pihak');
            $table->integer('qty')->default(1);
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->text('catatan')->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->date('tanggal_pelunasan')->nullable();
            $table->enum('status', ['belum lunas', 'lunas', 'sebagian'])->default('belum lunas');
            $table->enum('jenis_transaksi', ['hutang', 'piutang']);
            $table->string('pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hutang_piutang');
    }
};
