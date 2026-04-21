<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Presence
 * Représente le pointage d'un agent (présent, absent ou retard)
 *
 * Ce modèle enregistre les présences des agents pour chaque jour travaillé
 */
class Presence extends Model
{
    /**
     * Les attributs qui peuvent être remplis en masse
     *
     * @var array
     */
    protected $fillable = [
        'agent_id', // ID de l'agent qui a pointé (clé étrangère)
        'date',     // Date du pointage
        'statut',   // Statut : 'present', 'absent' ou 'retard'
    ];

    /**
     * Relation avec le modèle Agent
     * Une présence appartient à un agent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        // belongsTo signifie que cette présence appartient à un agent
        return $this->belongsTo(Agent::class);
    }
}

