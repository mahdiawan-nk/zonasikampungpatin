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
        Schema::create('data_estimasi_panens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_seeding_id');
            $table->decimal('sgr', 5, 4);
            $table->integer('target_weight');
            $table->integer('estimated_days');
            $table->date('estimated_harvest_date');
            $table->text('notes')->nullable();
            $table->foreign('data_seeding_id')->references('id')->on('data_seedings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_estimasi_panens');
    }
};
