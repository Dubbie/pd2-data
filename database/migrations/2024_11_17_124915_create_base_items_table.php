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
        Schema::create('base_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_code');
            $table->string('code');
            $table->string('type');
            $table->string('type2')->nullable();
            $table->unsignedSmallInteger('rarity')->nullable();
            $table->unsignedInteger('level'); // Base item level
            $table->unsignedInteger('magic_level')->nullable(); // mLVL (additional magic level)
            $table->unsignedInteger('auto_prefix')->nullable(); // Automagic.txt
            $table->string('normal_code'); // Normal code
            $table->string('exceptional_code')->nullable(); // Uber code
            $table->string('elite_code')->nullable(); // Ultra code
            $table->unsignedSmallInteger('inventory_width');
            $table->unsignedSmallInteger('inventory_height');
            $table->string('inventory_image');
            $table->string('unique_image')->nullable();
            $table->string('set_image')->nullable();
            $table->boolean('has_sockets')->default(false);
            $table->unsignedSmallInteger('socket_count')->default(0);
            $table->unsignedSmallInteger('socket_apply_type')->nullable();
            $table->boolean('is_unique_only')->default(false);
            $table->boolean('skip_name')->default(false); // Skip base name
            $table->json('attributes')->nullable(); // Dynamic attributes based on item type such as weapon, armor
            $table->string('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_items');
    }
};
