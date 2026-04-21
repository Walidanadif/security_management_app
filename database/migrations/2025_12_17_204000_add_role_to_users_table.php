<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour ajouter le champ 'role' à la table users
 *
 * Cette migration ajoute :
 * - Un champ 'role' de type enum avec les valeurs 'admin' et 'agent'
 * - La valeur par défaut est 'agent'
 */
return new class extends Migration
{
    /**
     * Exécute la migration
     * Ajoute le champ 'role' à la table 'users'
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajout du champ role avec valeurs possibles : 'admin' ou 'agent'
            // Valeur par défaut : 'agent'
            $table->enum('role', ['admin', 'agent'])->default('agent');
        });
    }

    /**
     * Annule la migration
     * Supprime le champ 'role' de la table 'users'
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Suppression du champ 'role' si on annule la migration
            // Note: Cette partie est vide dans l'original, à compléter si nécessaire
        });
    }
};

