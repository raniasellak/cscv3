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
        Schema::create('inscriptions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('formation_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // <-- ici
    $table->string('nom');
    $table->string('email');
    $table->timestamps();

    $table->unique(['email', 'formation_id']); // Empêche les doublons
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
