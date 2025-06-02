<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('favorite_characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_list_id')->constrained('character_lists')->cascadeOnDelete();
            $table->string('character_id')->unique();
            $table->string('name');
            $table->string('race')->nullable();
            $table->string('wiki_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorite_characters');
    }
};
