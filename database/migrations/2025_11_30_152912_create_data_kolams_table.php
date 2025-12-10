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
        Schema::create('data_kolams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kolam');
            $table->string('jenis_kolam');
            $table->string('panjang');
            $table->string('lebar');
            $table->string('kedalaman');
            $table->string('kapasitas');
            $table->string('status');
            $table->json('polygon')->nullable();
            $table->json('cordinate')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kolams');
    }
};
