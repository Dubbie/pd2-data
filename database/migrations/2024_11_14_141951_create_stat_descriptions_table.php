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
        Schema::create('stat_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('stat_name');
            $table->string('positive_code')->nullable();
            $table->string('negative_code')->nullable();
            $table->string('extra_code')->nullable();
            $table->string('positive')->nullable();
            $table->string('negative')->nullable();
            $table->string('extra')->nullable();
            $table->unsignedInteger('priority')->default(0);
            $table->unsignedInteger('function');
            $table->unsignedInteger('value')->default(1);
            $table->unsignedInteger('group')->nullable();
            $table->unsignedInteger('group_function')->nullable();
            $table->unsignedInteger('group_value')->default(1);
            $table->string('group_positive_code')->nullable();
            $table->string('group_negative_code')->nullable();
            $table->string('group_extra_code')->nullable();
            $table->string('group_positive')->nullable();
            $table->string('group_negative')->nullable();
            $table->string('group_extra')->nullable();

            // FK
            $table->foreign('stat_name')->references('name')->on('stats')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stat_descriptions');
    }
};
