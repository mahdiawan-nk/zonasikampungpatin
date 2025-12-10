<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('map_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layer_id')->constrained('map_layers')->onDelete('cascade');
            $table->string('feature_id');
            $table->string('geometry_type');
            $table->json('coordinates');
            $table->json('properties');
            $table->string('hash');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_features');
    }
};
