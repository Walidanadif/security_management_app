<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Site
 * Représente un site de sécurité
 *
 * Un site est un lieu où les agents sont affectés pour leurs missions
 */
class Site extends Model
{
    /**
     * Les attributs qui peuvent être remplis en masse
     *
     * @var array
     */
    protected $fillable = [
        'nom',      // Nom du site
        'adresse',  // Adresse du site
    ];

    /**
     * Relation avec le modèle Planning
     * Un site peut avoir plusieurs plannings (affectations d'agents)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plannings()
    {
        // hasMany signifie qu'un site peut avoir plusieurs plannings
        return $this->hasMany(Planning::class);
    }
}

