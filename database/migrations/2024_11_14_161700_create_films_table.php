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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique(); // Nom du film
            $table->string('image', 255)->nullable(); // URL de l'image du film
            $table->integer('rating')->default(0); // Note du film
            $table->string('date')->nullable(); // Date de sortie du film
            $table->text('description')->nullable(); // Description du film
            $table->string('trailer', 255)->nullable(); // URL de la bande-annonce
            $table->unsignedBigInteger('categorieID'); // Clé étrangère vers la catégorie
            
            // Définir la clé étrangère et la relation avec la table 'categories'
            $table->foreign('categorieID')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('restrict'); // Action lors de la suppression de la catégorie
                  
            $table->timestamps(); // Horodatage created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
