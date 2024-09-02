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
    Schema::create('equipements', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('marque');
        $table->string('model');
        $table->string('numeroSerie')->unique();
        $table->date('dateAchat');
        $table->string('codeQr')->unique();
        $table->string('localisation');
        $table->date('garantieExp');
        $table->float('prix');
        $table->integer('stock');
        // Utilisation correcte de foreignId et constrained
        $table->foreignId('magasin_id')->constrained('magasins')->onDelete('cascade');
        $table->foreignId('fournisseur_id')->constrained('fournisseurs')->onDelete('cascade');
        $table->foreignId('gestionnaire_id')->constrained('gestionnaires')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipements');
    }
};
