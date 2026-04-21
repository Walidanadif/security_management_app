<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer la table 'plannings'
 *
 * Cette migration crée la table des plannings d'affectation
 * Un planning lie un agent à un site pour une date et des horaires précis
 */
return new class extends Migration
{
    /**
     * Exécute la migration
     * Crée la table 'plannings' avec ses champs
     */
    public function up(): void
    {
        Schema::create('plannings', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté

            // Clés étrangères
            // agent_id : lie le planning à un agent
            $table->foreignId('agent_id')
                  ->constrained('agents')
                  ->onDelete('cascade');

            // site_id : lie le planning à un site
            $table->foreignId('site_id')
                  ->constrained('sites')
                  ->onDelete('cascade');

            // Informations temporelles
            $table->date('date');       // Date du planning
            $table->time('heure_debut'); // Heure de début du service
            $table->time('heure_fin');   // Heure de fin du service

            $table->timestamps(); // Dates de création et modification
        });
    }

    /**
     * Annule la migration
     * Supprime la table 'plannings'
     */
    public function down(): void
    {
        Schema::dropIfExists('plannings');
    }
};

