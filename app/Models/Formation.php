<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'nom_de_formation',
        'description',
        'date_de_debut',
        'date_limite_d_inscription',
    ];

    public function User()
    {
      return $this->belongsToMany(User::class);
    }
}
