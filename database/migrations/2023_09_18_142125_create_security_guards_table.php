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
        Schema::create('security_guards', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('cin');
            $table->string('adresse')->nullable();
            $table->string('image')->nullable();
            $table->enum('categorie', ['chef', 'Security']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_guards');
    }
};
