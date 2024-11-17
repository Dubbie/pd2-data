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
        Schema::create('unique_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('base_item_id');
            $table->string('name');
            $table->string('name_code');
            $table->string('code');
            $table->unsignedSmallInteger('rarity')->nullable();
            $table->unsignedInteger('level');
            $table->json('attribute_override');
            $table->string('inventory_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unique_items');
    }
};
