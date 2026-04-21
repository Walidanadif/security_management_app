<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * Modèle Agent
 * Représente un agent de sécurité dans le système
 *
 * Un agent est lié à un utilisateur (User) et peut avoir plusieurs plannings et présences
 */
class Agent extends Model
{
    /**
     * Les attributs qui peuvent être remplis en masse
     * Ce sont les champs qui peuvent être assignés lors de la création/mise à jour
     *
     * @var array
     */
    protected $fillable = [
        'nom',          // Nom de l'agent
        'telephone',    // Numéro de téléphone de l'agent
        'adresse',      // Adresse de l'agent
        'user_id',      // ID de l'utilisateur associé (clé étrangère)
    ];

    /**
     * Relation avec le modèle User
     * Un agent appartient à un utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // belongsTo signifie que l'agent appartient à un utilisateur
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le modèle Planning
     * Un agent peut avoir plusieurs plannings (affectations)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plannings()
    {
        // hasMany signifie qu'un agent peut avoir plusieurs plannings
        return $this->hasMany(Planning::class);
    }

    /**
     * Relation avec le modèle Presence
     * Un agent peut avoir plusieurs présences (pointages)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presences()
    {
        // hasMany signifie qu'un agent peut avoir plusieurs présences
        return $this->hasMany(Presence::class);
    }
}

