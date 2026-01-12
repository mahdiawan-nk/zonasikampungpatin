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
        Schema::table('data_seedings', function (Blueprint $table) {
            $table->integer('estimated_days')->nullable();
            $table->date('estimated_harvest_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_seedings', function (Blueprint $table) {
            $table->dropColumn('estimated_days');
            $table->dropColumn('estimated_harvest_date');
        });
    }
};
