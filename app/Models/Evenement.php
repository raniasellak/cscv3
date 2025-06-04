<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $table = 'evenements';

    protected $fillable = [
    'titre',
    'description',
    'long_description', // ajouté ici
    'date',
    'lieu',
    'agenda',
    'image',
];


    protected $dates = [
        'date',
        'created_at',
        'updated_at',
    ];

    // Pour que l’attribut agenda soit automatiquement casté en tableau
    protected $casts = [
        'date' => 'datetime',
        'agenda' => 'array',
    ];
}
