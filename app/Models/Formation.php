<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'title', 'description', 'category', 'recording',
        'support_course', 'formateur_email', 'date'
    ];
    public function inscriptions()
{
    return $this->hasMany(Inscription::class);
}


}
