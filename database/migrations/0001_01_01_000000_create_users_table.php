<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer la table users
 *
 * Cette migration crée :
 * - La table 'users' pour stocker les informations des utilisateurs
 * - La table 'password_reset_tokens' pour la réinitialisation de mot de passe
 * - La table 'sessions' pour la gestion des sessions utilisateur
 */
return new class extends Migration
{
    /**
     * Exécute les migrations
     * Crée les tables nécessaires à l'authentification
     */
    public function up(): void
    {
        // Création de la table 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id();                    // ID auto-incrémenté
            $table->string('name');          // Nom de l'utilisateur
            $table->string('email')->unique(); // Email unique
            $table->timestamp('email_verified_at')->nullable(); // Date de vérification email
            $table->string('password');      // Mot de passe haché
            $table->rememberToken();         // Jeton pour "Se souvenir de moi"
            $table->timestamps();            // Dates de création et modification
        });

        // Création de la table 'password_reset_tokens'
        // Stocke les tokens pour la réinitialisation de mot de passe
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email (clé primaire)
            $table->string('token');           // Token de réinitialisation
            $table->timestamp('created_at')->nullable(); // Date de création
        });

        // Création de la table 'sessions'
        // Stocke les informations de session utilisateur
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();   // ID de session
            $table->foreignId('user_id')->nullable()->index(); // ID utilisateur (clé étrangère)
            $table->string('ip_address', 45)->nullable(); // Adresse IP
            $table->text('user_agent')->nullable(); // User agent du navigateur
            $table->longText('payload');       // Données de la session
            $table->integer('last_activity')->index(); // Dernière activité
        });
    }

    /**
     * Annule les migrations
     * Supprime les tables créées
     */
    public function down(): void
    {
        // Supprime les tables dans l'ordre inverse de création
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

