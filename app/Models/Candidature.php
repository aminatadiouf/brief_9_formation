<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;
    protected $fillable =
    [
      'user_id' ,
      'formation_id',
      'statut_recervation'
    ];

    

    
    public function User()
    {
      return $this->belongsToMany(User::class);
    }

    public function Formation()
    {
      return $this->belongsToMany(Formation::class);
    }
}
