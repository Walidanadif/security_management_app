<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Agent;

/**
 * Modèle User
 * Représente un utilisateur du système (admin ou agent)
 *
 * Ce modèle utilise le système d'authentification de Laravel
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être remplis en masse
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',      // Nom de l'utilisateur
        'email',     // Adresse email (unique)
        'password',  // Mot de passe (haché)
        'role',      // Rôle : 'admin' ou 'agent'
    ];

    /**
     * Les attributs qui doivent être masqués lors de la sérialisation
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',        // Le mot de passe ne doit jamais être exposé
        'remember_token',  // Jeton de remember me
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Cast en objet Carbon
            'password' => 'hashed',           // Le mot de passe est automatiquement haché
        ];
    }

    /**
     * Relation avec le modèle Agent
     * Un utilisateur peut avoir un profil agent associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agent()
    {
        // hasOne signifie qu'un utilisateur peut avoir un agent
        return $this->hasOne(Agent::class);
    }
}

