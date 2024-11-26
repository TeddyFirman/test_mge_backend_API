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
        Schema::create('master_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->string('stok')->default(0);
            $table->string('harga')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        Schema::create('barang_hargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('master_barangs')->onDelete('cascade');
            $table->decimal('harga', 15, 2);
            $table->date('tanggal_berlaku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_hargas');
        Schema::dropIfExists('master_barangs');
    }
};
