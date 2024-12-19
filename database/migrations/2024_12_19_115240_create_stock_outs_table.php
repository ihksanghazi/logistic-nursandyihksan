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
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->ulid('id');
            $table->string('kode_barang'); // foreign key
            $table->string('no_barang_keluar');
            $table->integer('quantity');
            $table->string('destination');
            $table->date('tanggal_keluar');
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('kode_barang')->references('kode_barang')->on('stocks')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_outs');
    }
};
