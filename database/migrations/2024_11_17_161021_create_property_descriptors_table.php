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
        Schema::create('property_descriptors', function (Blueprint $table) {
            $table->id();
            $table->string('property_code'); // References 'code' on 'properties' table
            $table->string('min')->nullable();
            $table->string('max')->nullable();
            $table->string('param')->nullable();

            // Polymorphic fields
            $table->unsignedBigInteger('describable_id');
            $table->string('describable_type');

            $table->foreign('property_code')->references('code')->on('properties')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_descriptors');
    }
};
