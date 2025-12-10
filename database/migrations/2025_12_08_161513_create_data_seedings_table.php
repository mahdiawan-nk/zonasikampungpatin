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
        Schema::create('data_seedings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_kolam_id');
            $table->date('tanggal_penebaran');
            $table->string('jenis_benih');
            $table->integer('jumlah_ikan');
            $table->integer('berat_rata_rata')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreign('data_kolam_id')->references('id')->on('data_kolams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_seedings');
    }
};
