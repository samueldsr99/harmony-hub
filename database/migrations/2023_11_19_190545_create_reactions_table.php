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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('playlist_id')->references('id')->on('playlists')->onDelete('cascade');
            $table->foreignId('reaction_type_id')->references('id')->on('reaction_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
