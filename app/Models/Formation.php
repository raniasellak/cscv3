<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'formateur_email',
        'date',
        'contenu',
        'support_course', // <-- Ajout ici
    ];
    public function inscriptions()
{
    return $this->hasMany(Inscription::class);
}


}
