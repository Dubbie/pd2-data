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
        Schema::create('stats', function (Blueprint $table) {
            $table->string('name')->primary();
            $table->unsignedInteger('id');
            $table->boolean('f_min')->default(false);
            $table->unsignedInteger('min_accr')->nullable();
            $table->boolean('is_direct')->default(false);
            $table->string('max_stat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
