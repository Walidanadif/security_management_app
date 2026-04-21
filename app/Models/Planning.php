<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Planning
 * Représente une affectation d'un agent à un site pour une période donnée
 *
 * Un planning définit quand et où un agent doit travailler
 */
class Planning extends Model
{
    /**
     * Les attributs qui peuvent être remplis en masse
     *
     * @var array
     */
    protected $fillable = [
        'agent_id',     // ID de l'agent affecté (clé étrangère)
        'site_id',      // ID du site d'affectation (clé étrangère)
        'date',         // Date du planning
        'heure_debut',  // Heure de début du service
        'heure_fin',    // Heure de fin du service
    ];

    /**
     * Relation avec le modèle Agent
     * Un planning appartient à un agent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        // belongsTo signifie que ce planning appartient à un agent
        return $this->belongsTo(Agent::class);
    }

    /**
     * Relation avec le modèle Site
     * Un planning appartient à un site
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        // belongsTo signifie que ce planning appartient à un site
        return $this->belongsTo(Site::class);
    }
}

