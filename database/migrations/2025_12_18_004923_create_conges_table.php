<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer la table 'conges'
 *
 * Cette migration crée la table des demandes de congés
 * Elle enregistre les congés demandés par les agents
 */
return new class extends Migration
{
    /**
     * Exécute la migration
     * Crée la table 'conges' avec ses champs
     */
    public function up(): void
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté

            // Clé étrangère vers la table 'agents'
            // Lie le congé à un agent spécifique
            $table->foreignId('agent_id')
                  ->constrained('agents')
                  ->onDelete('cascade');

            // Dates du congé
            $table->date('date_debut'); // Date de début du congé
            $table->date('date_fin');   // Date de fin du congé

            // Statut de la demande de congé
            // 'en_attente' : en attente de validation
            // 'accepte' : congé validé
            // 'refuse' : congé rejeté
            $table->enum('statut', ['en_attente', 'accepte', 'refuse'])
                  ->default('en_attente');

            $table->timestamps(); // Dates de création et modification
        });
    }

    /**
     * Annule la migration
     * Supprime la table 'conges'
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};

