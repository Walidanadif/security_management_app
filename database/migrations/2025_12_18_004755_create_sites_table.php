<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer la table 'sites'
 *
 * Cette migration crée la table des sites de sécurité
 * Un site représente un lieu où les agents sont affectés
 */
return new class extends Migration
{
    /**
     * Exécute la migration
     * Crée la table 'sites' avec ses champs
     */
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté

            // Informations du site
            $table->string('nom');      // Nom du site
            $table->string('adresse');  // Adresse du site

            $table->timestamps(); // Dates de création et modification
        });
    }

    /**
     * Annule la migration
     * Supprime la table 'sites'
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};

