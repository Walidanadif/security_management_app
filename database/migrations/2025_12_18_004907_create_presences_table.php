<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer la table 'presences'
 *
 * Cette migration crée la table des pointages/présences
 * Elle enregistre le statut de présence d'un agent pour chaque jour
 */
return new class extends Migration
{
    /**
     * Exécute la migration
     * Crée la table 'presences' avec ses champs
     */
    public function up(): void
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté

            // Clé étrangère vers la table 'agents'
            // Lie la présence à un agent spécifique
            $table->foreignId('agent_id')
                  ->constrained('agents')
                  ->onDelete('cascade');

            $table->date('date'); // Date du pointage

            // Statut de la présence
            // 'present' : agent présent
            // 'absent' : agent absent
            // 'retard' : agent en retard
            $table->enum('statut', ['present', 'absent', 'retard']);

            $table->timestamps(); // Dates de création et modification
        });
    }

    /**
     * Annule la migration
     * Supprime la table 'presences'
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};

