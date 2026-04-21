<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer la table 'agents'
 *
 * Cette migration crée la table des agents de sécurité
 * Un agent est lié à un utilisateur (User) via une clé étrangère
 */
return new class extends Migration
{
    /**
     * Exécute la migration
     * Crée la table 'agents' avec ses champs
     */
    public function up(): void
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté

            // Informations personnelles de l'agent
            $table->string('nom');           // Nom de l'agent
            $table->string('telephone');     // Numéro de téléphone
            $table->string('adresse');       // Adresse

            // Clé étrangère vers la table 'users'
            // onDelete('cascade') : si l'utilisateur est supprimé, l'agent l'est aussi
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps(); // Dates de création et modification
        });
    }

    /**
     * Annule la migration
     * Supprime la table 'agents'
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};

