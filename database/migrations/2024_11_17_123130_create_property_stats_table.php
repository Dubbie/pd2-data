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
        Schema::create('property_stats', function (Blueprint $table) {
            $table->id();
            $table->string('set_stat')->nullable();
            $table->string('value')->nullable();
            $table->string('function');
            $table->string('stat_name')->nullable();
            $table->string('property_code');

            $table->foreign('property_code')->references('code')->on('properties')->cascadeOnDelete();
            $table->foreign('stat_name')->references('name')->on('stats')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_stats');
    }
};
